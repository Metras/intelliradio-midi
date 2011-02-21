package fbIntegration;
import java.io.*;
import java.net.*;
import java.util.*;
public class Messages {
    private static String fbAppKey;
    private static int profileId;
    private static String access_key;

    public void setAppKey(String key) {
        fbAppKey = key;
    }
    public void setProfileId(int id) {
        profileId = id;
    }
    public void setAccessKey(String key) {
        access_key = key;
    }
    public LinkedList getMessages() {
        LinkedList messages = new LinkedList();
        return messages;
    }
}
