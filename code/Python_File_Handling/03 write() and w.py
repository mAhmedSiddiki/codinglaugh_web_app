#                                   file
#                                  write()
#                         active write mode --> "w"
#   create a new file
#   same file --> old is delete and new create
f = open("codee.txt","w")
f.write("i am kolimuddin\n")
f.write("i am kolimuddin\n")
f.write("i am kolimuddin")
f.close()
