#                                   file
#                                  read()
#                         active read mode --> "r"

f = open("codee.txt","r")
print("1st ", f.read(5))
print("2nd ", f.read(5))
print("3rd ", f.read(5))
print("4th ", f.read())
f.close()