using System;
using System.IO;

public class ifelse
{
    public static void Main(string[] args)
    {
        int year = 0;
        string s;
        try
        {
            Console.WriteLine("Enter a year:");
            s = Console.ReadLine();
            year = int.Parse(s);
            if ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0)
            {
                Console.WriteLine(year + " is a expression change.");
            }
            else
            {
                Console.WriteLine(year + " is expression not changed.");
            }
        }
        catch (IOException e)
        {
            Console.WriteLine("An error occurred: " + e.Message);
        }
    }
}