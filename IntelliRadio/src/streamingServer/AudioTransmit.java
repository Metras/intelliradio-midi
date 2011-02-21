package streamingServer;

import java.awt.*;
import javax.media.*;
import javax.media.protocol.*;
import javax.media.protocol.DataSource;
import javax.media.format.*;
import javax.media.control.TrackControl;
import javax.media.control.QualityControl;
import java.io.*;

public class AudioTransmit {

    // Input MediaLocator
    // Can be a file or http or capture source
    private MediaLocator locator;
    private String ipAddress;
    private String port;

    private Processor processor = null;
    private DataSink  rtptransmitter = null;
    private DataSource dataOutput = null;
    
    public AudioTransmit(MediaLocator locator,
			 String ipAddress,
			 String port) {
	
	this.locator = locator;
	this.ipAddress = ipAddress;
	this.port = port;
    }

    /**
     * Starts the transmission. Returns null if transmission started ok.
     */
    public synchronized String start() {
	String result;

	// Create a processor for the specified media locator
	
	result = createProcessor();
	if (result != null)
	    return result;

	// Create an RTP session 
	result = createTransmitter();
	if (result != null) {
	    processor.close();
	    processor = null;
	    return result;
	}

	// Start the transmission
	processor.start();
	
	return null;
    }

    /**
     * Stops the transmission if already started
     */
    public void stop() {
	synchronized (this) {
	    if (processor != null) {
		processor.stop();
		processor.close();
		processor = null;
		rtptransmitter.close();
		rtptransmitter = null;
	    }
	}
    }

    private String createProcessor() {
	if (locator == null)
	    return "Locator is null";

	DataSource ds;
	DataSource clone;

	try {
	    ds = Manager.createDataSource(locator);
	} catch (Exception e) {
	    return "Couldn't create DataSource";
	}

	// Try to create a processor to handle the input media locator
	try {
	    processor = Manager.createProcessor(ds);
	} catch (NoProcessorException npe) {
	    return "Couldn't create processor";
	} catch (IOException ioe) {
	    return "IOException creating processor";
	} 

	// Wait for it to configure
	boolean result = waitForState(processor, Processor.Configured);
	if (result == false)
	    return "Couldn't configure processor";

	// Get the tracks from the processor
	TrackControl [] tracks = processor.getTrackControls();

	if (tracks == null || tracks.length < 1)
	    return "Couldn't find tracks in processor";

	boolean programmed = false;
      AudioFormat afmt;

	// Search through the tracks for a Audio track
	for (int i = 0; i < tracks.length; i++) {
	    Format format = tracks[i].getFormat();
	    if (  tracks[i].isEnabled() &&
		  format instanceof AudioFormat &&
		  !programmed) {
		afmt = (AudioFormat)tracks[i].getFormat();
                       AudioFormat ulawFormat =   new AudioFormat(AudioFormat.DVI_RTP);
                                            
            
		tracks[i].setFormat (ulawFormat);
		System.err.println("Audio transmitted as:");
		System.err.println("  " + ulawFormat);
		// Assume succesful
		programmed = true;
	    } else
		tracks[i].setEnabled(false);
	}

	if (!programmed)
	    return "Couldn't find Audio track";

	// Set the output content descriptor to RAW_RTP
       ContentDescriptor cd = new ContentDescriptor(ContentDescriptor.RAW_RTP);
       processor.setContentDescriptor(cd);

	// Realize the processor. 
	result = waitForState(processor, Controller.Realized);
	if (result == false)
	    return "Couldn't realize processor";

	
	// Get the output data source of the processor
	dataOutput = processor.getDataOutput();
	return null;
    }

    
    private String createTransmitter() {
	String rtpURL = "rtp://" + ipAddress + ":" + port + "/audio";
	MediaLocator outputLocator = new MediaLocator(rtpURL);

	try {
	    rtptransmitter = Manager.createDataSink(dataOutput, outputLocator);
	    rtptransmitter.open();
	    rtptransmitter.start();
	    dataOutput.start();
	} catch (MediaException me) {
	    return "Couldn't create RTP data sink";
	} catch (IOException ioe) {
	    return "Couldn't create RTP data sink";
	}
	
	return null;
    }


    /****************************************************************
     *methods to handle processor's state changes.
     ****************************************************************/
    
    private Integer stateLock = new Integer(0);
    private boolean failed = false;
    
    Integer getStateLock() {
	return stateLock;
    }

    void setFailed() {
	failed = true;
    }
    
    private synchronized boolean waitForState(Processor p, int state) {
	p.addControllerListener(new StateListener());
	failed = false;

	// Call the required method on the processor
	if (state == Processor.Configured) {
	    p.configure();
	} else if (state == Processor.Realized) {
	    p.realize();
	}
	
	// Wait until we get an event that confirms the
	// success of the method, or a failure event.
	// See StateListener inner class
	while (p.getState() < state && !failed) {
	    synchronized (getStateLock()) {
		try {
		    getStateLock().wait();
		} catch (InterruptedException ie) {
		    return false;
		}
	    }
	}

	if (failed)
	    return false;
	else
	    return true;
    }

    /****************************************************************
     * StateListenerInner Class
     ****************************************************************/

    class StateListener implements ControllerListener {

	public void controllerUpdate(ControllerEvent ce) {

	    // If there was an error during configure or
	    // realize, the processor will be closed
	    if (ce instanceof ControllerClosedEvent)
		setFailed();

	    // All controller events, send a notification
	    // to the waiting thread in waitForState method.
	    if (ce instanceof ControllerEvent) {
		synchronized (getStateLock()) {
		    getStateLock().notifyAll();
		}
	    }
	}
    }


    
    public static void main(String [] args) {
	String path="file:C:/Users/Thusira/Desktop/Testing/hope.mp3";
	String ip="123.231.42.49";
	String prt="42050";
	AudioTransmit at = new AudioTransmit(new MediaLocator(path),ip,prt);
	// Start the transmission
	String result = at.start();

	// result will be non-null if there was an error. The return
	// value is a String describing the possible error. Print it.
	if (result != null) {
	    System.err.println("Error : " + result);
	    System.exit(0);
	}

	System.err.println("Start transmission for 120 seconds...");
	
	// Transmit for 60 seconds 
	
	try {
	    Thread.currentThread().sleep(120000);
	} catch (InterruptedException ie) {
	}

	// Stop the transmission
	at.stop();

	System.err.println("...transmission ended.");
	
	System.exit(0);
    }
}
