#                                  file
#                      create file in other directory
#                          write()  and  read()

import os
# change directory
os.chdir("E:/GAME/PC")

# f = open("codinglaugh.txt","w")
# f.write("Solimuddin: Hey i am here....\n")
# f.write("Solimuddin: Hey i am here....\n")
# f.write("Solimuddin: Hey i am here....\n")
# f.write("Solimuddin: Hey i am here....")

f = open("codinglaugh.txt","r")
print(f.read())
f.close()
