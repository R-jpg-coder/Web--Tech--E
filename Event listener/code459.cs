using System;

class Student
{
    int Roll;
    string Name;
    float Mark;

    public void GetData()
    {
        Roll = 96002;
        Name = "Tahsin";
        Mark = 86.67f;
    }

    public void Display()
    {
        Console.WriteLine("Roll is: " + Roll);
        Console.WriteLine("Name is: " + Name);
        Console.WriteLine("Mark is: " + Mark);
    }
}

public class Friend
{
    public static void Main(string[] args)
    {
        Student s = new Student();
        s.GetData();
        s.Display();
    }
}

