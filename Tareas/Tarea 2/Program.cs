using System;

namespace primerProyecto
{
    class Program
    {
        static void Main(string[] args)
        {
            int x, fila = 1;
            Console.WriteLine("Ingrese el numero de filas que desea imprimir: ");
            x = Convert.ToInt32(Console.ReadLine());
            int[,] matriz = new int[x, x];

            for (int i = 0; i < x; i++)
            {
                for (int j = 0; j < fila; j++)
                {
                    if ((j == 0) || (j == fila - 1))
                        matriz[i, j] = 1;
                    else
                        matriz[i, j] = matriz[i - 1, j] + matriz[i - 1, j - 1];
                }
                fila++;
            }
            System.Console.Clear();
            fila = 1;
            int posX, posY = 1;
            System.Console.Clear();

            for (int i = 0; i < x; i++)
            {
                posX = 55 - (i * 2);
                for (int j = 0; j < fila; j++)
                {
                    Console.SetCursorPosition(posX, posY);
                    Console.Write(matriz[i, j]);
                    posX += 4;
                }
                Console.WriteLine();
                posY += 1;
                fila++;
            }

            Console.WriteLine("\n\n\n Pulse una tecla para continuar...");
            Console.ReadLine();
        }
    }
}
