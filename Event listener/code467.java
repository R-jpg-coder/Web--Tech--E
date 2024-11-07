import java.io.*;
public class tswitch
{
    public static void main(String args[])
{
    int year=0;
    String s;
    try
    {
        inputStreamReader IN=new InputStreamReader(System.in);
        BufferReader BR=new BufferedReader(IN);
        System.out.print("Enter your Academic Year(From 1 to 4):");
        s=BR.raedLine();
        year=Integer.parseInt(s);
        switch(year)
        {
            case 1:
                System.out.println("You are a student of first year");
                break;
                
            case 2:
                System.out.println("You are a student of Second year");
                break;
                
            case 3:
                System.out.println("You area a student of Third year");
                break;
                default:
                System.out.println("Wrong Input");
                
        }
    }
    catch(Exception e){}
}
}
        }
    }
}    
}