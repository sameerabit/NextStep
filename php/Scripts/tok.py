import requests
import time


def get_tiktok_username(username):
    url = "https://www.tiktok.com/@{username}"
    response = requests.get(url)
    if response.status_code == 200:
        return response.url.split("/")[-1]
    else:
        return None


def follow_user(username):
    url = "https://www.tiktok.com/api/user/follow/?user_id={username}"
    response = requests.post(url)
    if response.status_code == 200:
        return True
    else:
        return False


def main():
    username = "labandicom"
    if not get_tiktok_username(username):
        print("User not found")
        return

    if not follow_user(username):
        print("Failed to follow user")
        return

    print("Successfully followed user")


if __name__ == "__main__":
    main()
