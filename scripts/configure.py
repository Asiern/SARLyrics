import os


class text:
    black = '\033[30m'
    red = '\033[31m'
    green = '\033[32m'
    orange = '\033[33m'
    blue = '\033[34m'
    purple = '\033[35m'
    cyan = '\033[36m'
    lightgrey = '\033[37m'
    darkgrey = '\033[90m'
    lightred = '\033[91m'
    lightgreen = '\033[92m'
    yellow = '\033[93m'
    lightblue = '\033[94m'
    pink = '\033[95m'
    lightcyan = '\033[96m'
    reset = '\033[0m'
    bold = '\033[01m'


_dir = os.getcwd()

print(text.lightcyan+"Project configurer"+text.reset)

print("\nConfiguring " + text.red+"Last.fm"+text.reset+" API")
key_path = _dir + "/src/config/api.key"
f = open(key_path, "w")
key = input("Enter Last.fm Api Key (Press Enter to Skip): ")
f.write(key)
f.close()

print("\nConfiguring .env")
src = _dir+"/src/.env.example"
dst = _dir+"/src/.env"

f = open(src, "r")
os.remove(dst)
out = open(dst, "a")
for line in f.readlines():
    name, value = line.split("=")
    value = value.strip("\n")
    _input = input(text.bold+name+text.reset +
                   " (Current value: "+value+" press ENTER to mantain current value): ")
    if _input != "":
        value = _input
    out.write(name+"="+value+"\n")

print("\nConfiguring " + text.green + "node modules: "+text.reset)
response = ""
while (response != "Y") and (response != "N"):
    response = input("This will install node packages. Continue? (Y/N): ")

if response == "Y":
    os.system("npm install")
else:
    print("Node installation skiped. Tailwindcss will not work properly.")
