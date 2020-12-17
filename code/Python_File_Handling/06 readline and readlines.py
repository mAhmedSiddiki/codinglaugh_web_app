#                                  file
#                        readline() and readlines()
#                         active read mode --> "r"

f = open("codee.txt","r")
# print(f.read())
# for i in f.read():
#     print(i)
# print(f.readline(),end="")
# print(f.readline(),end="")
# print(f.readline(),end="")
# print(f.readline(),end="")
# print(f.readline(),end="")
# print(f.readlines())
print(f.readable())
f.close()
