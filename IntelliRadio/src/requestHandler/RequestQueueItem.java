package requestHandler;

public class RequestQueueItem {
    public int requestId;
    public String fromName;
    public String request;
    private int receivedTime;
    public RequestQueueItem nextNode;
    public RequestQueueItem prevNode;

    public void setReceivedTime(int receivedTime) {
        this.receivedTime = receivedTime;
    }
    public int getReceivedTime() {
        return this.receivedTime;
    }
}
