package requestHandler;
import java.net.*;
/**
 *
 * @author Ramindu
 */
public class QueueSender {
    public int lastSentTime;
    private URL receiver;
    public URL getReceiver() {
        return this.receiver;
    }
    public void setReceiver(URL receiver) {
        this.receiver = receiver;
    }
    protected void send(RequestQueue requests) {

    }
}
