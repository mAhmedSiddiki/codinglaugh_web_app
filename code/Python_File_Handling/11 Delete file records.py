#                                   file
#                          delete - file records

import re
a=1
with open("codee.txt","r") as f:
    f_list = f.readlines()
    print(f_list)
    for i, j in enumerate(f_list):
        if i+1 == a:
            f_list[i] = ""
            a=a+1
        # if re.search(".*dog.*", j):
        #     f_list[i] = ""

with open("codee.txt","w") as f:
    f.writelines(f_list)

with open("codee.txt","r") as f:
    print(f.read())

