#recursion

def factorial(n):
    if n==1:
        return 1
    else:
        return n*factorial(n-1)

a = int(input("Enter a number: "))
print(factorial(a))