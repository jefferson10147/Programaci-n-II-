using System;
using System.IO;

namespace ejercicio_1
{
    class Program
    {
        static void Main(string[] args)
        {
            if(File.Exists("misiones.in"))
            {
                string [] data = File.ReadAllLines("misiones.in");
                string[] vAux;
                string [] givens;
                int i = 1, countingShips, distanceToTravel, shipsAvailable;
                float ans1, ans2;
                while (i<data.Length)
                {
                    vAux = data[i].Split(" ");
                    shipsAvailable = Int32.Parse(vAux[0]);
                    distanceToTravel = Int32.Parse(vAux[1]);
                    countingShips = 0;
                    for (int j = i+1; j <= (i+shipsAvailable); j++)
                    {
                        givens = data[j].Split(" ");
                        ans1 = (float) (distanceToTravel / float.Parse(givens[0]));
                        ans2 = (float) (float.Parse(givens[1]) / float.Parse(givens[2]));
                        if (ans1 <= ans2)
                            countingShips++;
                    }
                    Console.WriteLine(""+countingShips);
                    i += Int32.Parse(vAux[0])+1;
                }
                Console.WriteLine("\n\nPRESIONA CUALQUIER TECLA PARA CONTINUAR");
                Console.ReadKey();
            }
            else
                Console.WriteLine("Error no se encuentra el archivo");
        }
    }
}
