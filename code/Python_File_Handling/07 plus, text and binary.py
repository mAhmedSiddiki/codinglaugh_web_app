#                                   file
#                          plus || text and binary
#                      active mode --> "w" "a" "x" "r"
# + ->> write and read
# f = open("codee.txt","w+")
# print(f.writable())
# print(f.readable())
# f.close()
# t-> text
f = open("codee.txt","rb+")
print(f.writable())
print(f.readable())
f.close()
