package fbIntegration;
import requestHandler.RequestQueue;
public class Messages {
    private static String fbAppSecret;
    private static int profileId;
    private static String access_key;

    public void setAppSecret(String secret) {
        fbAppSecret = secret;
    }
    public void setProfileId(int id) {
        profileId = id;
    }
    public void setAccessKey(String key) {
        access_key = key;
    }
    public RequestQueue getMessages() {
        RequestQueue messages = new RequestQueue();
        return messages;
    }
}
