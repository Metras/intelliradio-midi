package requestHandler;
import java.util.Collection;
import java.util.LinkedList;
public class RequestQueue extends LinkedList {
    private RequestQueueItem firstNode;
    private RequestQueueItem lastNode;
    private static int limit = 10;
    public void setFirstNode(RequestQueueItem first) {
        this.firstNode = first;
    }
    public void setLastNode(RequestQueueItem last) {
        this.lastNode = last;
    }
    public void setLimit(int l) {
        limit = l;
    }
    public void add(RequestQueueItem nextItem) {
        this.lastNode.nextNode = nextItem;
    }
    public RequestQueueItem remove() {
        RequestQueueItem temp = new RequestQueueItem();
        temp = this.firstNode;
        this.firstNode = this.firstNode.nextNode;
        return temp;
    }
}
