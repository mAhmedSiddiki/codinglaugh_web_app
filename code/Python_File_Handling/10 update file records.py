#                                   file
#                          update - file records

import re
with open("codee.txt","r") as f:
    f_list = f.readlines()
    print(f_list)
    for i, j in enumerate(f_list):
        if re.search(".*dog.*", j):
            f_list[i] = "this is a cat\n"

with open("codee.txt","w") as f:
    f.writelines(f_list)

with open("codee.txt","r") as f:
    print(f.read())
