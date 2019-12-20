#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <math.h>

double func(double x) {
    return 150 - 0.09*(x-28)*(x-28) + 4 *sin(0.2*x) * log(x);
}

int main(int argc, char const *argv[])
{
    size_t start = 1576836030;
    int entry = 1;
    srand((unsigned) time(NULL));

    typedef struct point {
        size_t x;
        size_t y;
    } point_t;

    size_t start_x = 0;
    size_t end_x = 70;
    size_t count = end_x/2;
    point_t points[256];

    size_t step = (end_x - start_x) / count;

    size_t j = 0;
    for (size_t i = start_x; i <= end_x; i += step)
    {
        point_t p;
        p.x = i;
        p.y = (p.x < (5)) ? 20*p.x : func(p.x);
        points[j++] = p;
    }
    point_t p;
    p.x = end_x+step;
    p.y = 0;
    points[j++] = p;
    count++;


    // printf("[0");
    // for (size_t i = 1; i <= count; i++)
    // {
    //     printf(", %ld", points[i].x);
    // }
    // printf("]\n");

    // printf("[%ld", points[0].y);
    // for (size_t i = 1; i <= count; i++)
    // {
    //     printf(", %ld", points[i].y);
    // }
    // printf("]\n");



    for (size_t i = 1; i < count; i++)
    {
        entry = (points[i-1].y < points[i].y);
        //printf("%ld: %ld\n", points[i].x, points[i].y);
        printf("INSERT INTO TalkAttendance VALUES (1, %ld, %u)\n", start + points[i].x, entry);
    }
    
    

    return 0;
}
