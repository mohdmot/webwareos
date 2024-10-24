import os
print('''
 __          __  _                            ____   _____ 
 \ \        / / | |                          / __ \ / ____|
  \ \  /\  / /__| |____      ____ _ _ __ ___| |  | | (___  
   \ \/  \/ / _ \ '_ \ \ /\ / / _` | '__/ _ \ |  | |\___ \ 
    \  /\  /  __/ |_) \ V  V / (_| | | |  __/ |__| |____) |
     \/  \/ \___|_.__/ \_/\_/ \__,_|_|  \___|\____/|_____/ 
                                                           
Set the Admin User and Password..''')
# Take Inputs
user = input('[->] Username: ')
password = input('[->] Password: ')

f = open('login(delete_later).txt')
old_data = f.read().split('\n')
f.close()

# Edit it into login.php
login_php = open(f'api{os.sep}login.php')
login_php_text = login_php.read()
login_php.close()

login_php_text = login_php_text.replace(f"$PASSWORD = '{old_data[1]}';",f"$PASSWORD = '{password}';")
login_php_text = login_php_text.replace(f"$USERNAME = '{old_data[0]}';",f"$USERNAME = '{user}';")

login_php = open(f'api{os.sep}login.php','w')
login_php.write(login_php_text)
login_php.close()

# Edit Directories Name
os.rename(old_data[0],user)
os.rename(f'{user}{os.sep}{old_data[1]}', f'{user}{os.sep}{password}')

# Write New Data
f = open('login(delete_later).txt','w')
f.write(f'{user}\n{password}')
f.close()

input('[+] Done..')