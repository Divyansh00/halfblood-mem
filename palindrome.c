

#include <stdio.h>
#include <stdlib.h>
#include<string.h>
#include <limits.h>
struct Stack
{
    int top;
    unsigned capacity;
    char* array;
};
struct Stack* createStack(unsigned capacity)
{
    struct Stack* stack = (struct Stack*) malloc(sizeof(struct Stack));
    stack->capacity = capacity;
    stack->top = -1;
    stack->array = (char*) malloc(stack->capacity * sizeof(char));
    return stack;
}
 
int isFull(struct Stack* stack)
{
   return stack->top == stack->capacity - 1; 
}
 
int isEmpty(struct Stack* stack)
{
   return stack->top == -1;
}
void push(struct Stack* stack, char item)
{
    if (isFull(stack))
        return;
    stack->array[++stack->top] = item;
    printf("%c pushed to stack\n", item);
}
char pop(struct Stack* stack)
{
    if (isEmpty(stack))
        return ('n');
    return stack->array[stack->top--];
}
int main()
{

	int i=0;
	char a[100];
	scanf("%s", &a);
	int n=strlen(a);
	int count=1;
	struct Stack* st=createStack(n);
	while(a[i]!='#')
	{
		push(st, a[i]);
		i++;
		count++;
	}
	int ptr=0;
	char aa[100];
	char aaa[100];
	int le=0, lea=0;
	for(i=0;i<count-1;i++)
	{
		aa[le++]=pop(st);
	}
	for(i=count;i<n;i++)
	{
		aaa[lea++]=a[i];
	}
	printf("\n%s\t%s", aa, aaa);
	if(strcmp(strrev(aaa), aa))
	{
		printf("\n\n not palindrome\n\n");
	}
	else
	{
		printf("\n\n palindrome\n\n");
	}
}
