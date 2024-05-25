#include <stdio.h>

int main() {
    freopen("/flag.txt", "rb", stdin);
    char flag[100];
    scanf("%s", flag);
    puts(flag);
}
