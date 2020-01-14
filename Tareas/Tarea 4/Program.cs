using System;
using System.IO;

namespace ConsoleApp1
{
    class Program
    {
        static char[,] matriz;
        static int countingBoard = 1;
        static int CountSafeSquares()
        {
            int count = 0;
            for (int i = 0; i < matriz.GetLength(0); i++)
                for (int j = 0; j < matriz.GetLength(1); j++)
                    if (matriz[i, j] == 'o')
                        count++;

            return count;
        }
        static void SetXQueens(int auxi, int auxj)
        {
            int i, j;
            for (i = (auxi - 1); i >= 0; i--)
            {
                if (matriz[i, auxj] == 'o')
                    matriz[i, auxj] = 'x';

                if (matriz[i, auxj] == 'p' || matriz[i, auxj] == 'k')
                    break;
            }
            for (i = (auxi + 1); i < matriz.GetLength(0); i++)
            {
                if (matriz[i, auxj] == 'o')
                    matriz[i, auxj] = 'x';

                if (matriz[i, auxj] == 'p' || matriz[i, auxj] == 'k')
                    break;
            }
            for (j = (auxj - 1); j >= 0; j--)
            {
                if (matriz[auxi, j] == 'o')
                    matriz[auxi, j] = 'x';

                if (matriz[auxi, j] == 'p' || matriz[auxi, j] == 'k')
                    break;
            }
            for (j = (auxj + 1); j < matriz.GetLength(1); j++)
            {
                if (matriz[auxi, j] == 'o')
                    matriz[auxi, j] = 'x';

                if (matriz[auxi, j] == 'p' || matriz[auxi, j] == 'k')
                    break;
            }
            i = auxi; j = auxj;
            while ((i > -1) && (j > -1))
            {
                if (matriz[i, j] == 'o')
                    matriz[i, j] = 'x';

                if (matriz[i, j] == 'p' || matriz[i, j] == 'k')
                    break;

                i--; j--;
            }
            i = auxi; j = auxj;
            while ((i > -1) && (j < matriz.GetLength(1)))
            {
                if (matriz[i, j] == 'o')
                    matriz[i, j] = 'x';

                if (matriz[i, j] == 'p' || matriz[i, j] == 'k')
                    break;

                i--; j++;
            }
            i = auxi; j = auxj;
            while ((i < matriz.GetLength(0)) && (j > -1))
            {
                if (matriz[i, j] == 'o')
                    matriz[i, j] = 'x';

                if (matriz[i, j] == 'p' || matriz[i, j] == 'k')
                    break;

                i++; j--;
            }
            i = auxi; j = auxj;
            while ((i < matriz.GetLength(0)) && (j < matriz.GetLength(1)))
            {
                if (matriz[i, j] == 'o')
                    matriz[i, j] = 'x';

                if (matriz[i, j] == 'p' || matriz[i, j] == 'k')
                    break;

                i++; j++;
            }
        }
        static void  SetXKnights(int auxi, int auxj)
        {
            if (auxi - 2 >= 0 && auxj - 1 >= 0 && matriz[auxi - 2, auxj - 1] == 'o')
                matriz[auxi - 2, auxj - 1] = 'x';

            if (auxi - 1 >= 0 && auxj - 2 >= 0 && matriz[auxi - 1, auxj - 2] == 'o')
                matriz[auxi - 1, auxj - 2] = 'x';

            if (auxi - 2 >= 0 && auxj + 1 < matriz.GetLength(1) && matriz[auxi - 2, auxj + 1] == 'o')
                matriz[auxi - 2, auxj + 1] = 'x';

            if (auxi - 1 >= 0 && auxj + 2 < matriz.GetLength(1) && matriz[auxi - 1, auxj + 2] == 'o')
                matriz[auxi - 1, auxj + 2] = 'x';

            if (auxi + 1 < matriz.GetLength(0) && auxj + 2 < matriz.GetLength(1) && matriz[auxi + 1, auxj + 2] == 'o')
                matriz[auxi + 1, auxj + 2] = 'x';

            if (auxi + 2 < matriz.GetLength(0) && auxj + 1 < matriz.GetLength(1) && matriz[auxi + 2, auxj + 1] == 'o')
                matriz[auxi + 2, auxj + 1] = 'x';

            if (auxi + 1 < matriz.GetLength(0) && auxj - 2 >= 0 && matriz[auxi + 1, auxj - 2] == 'o')
                matriz[auxi + 1, auxj - 2] = 'x';

            if (auxi + 2 < matriz.GetLength(0) && auxj - 1 >= 0 && matriz[auxi + 2, auxj - 1] == 'o')
                matriz[auxi + 2, auxj - 1] = 'x';
        }
        static void AnalizeBoard()
        {
            for (int i = 0; i < matriz.GetLength(0); i++)
                for (int j = 0; j < matriz.GetLength(1); j++)
                {
                    if (matriz[i, j] == 'k')
                        SetXKnights(i, j);

                    if (matriz[i, j] == 'q')
                        SetXQueens(i, j);
                }
            
            Console.WriteLine("Board " + countingBoard + " has " + CountSafeSquares() + " safe squares.");
            countingBoard++;
        }
        static void SetOnBoardPiece(int row, int col, char piece)=> matriz[row - 1, col - 1] = piece;
        static void SetBounds (string[] aux, char piece)
        {
            int length = int.Parse(aux[0]);

            for (int i = 1; i < (length * 2); i += 2)
                SetOnBoardPiece(int.Parse(aux[i]), int.Parse(aux[i + 1]), piece);
        }
        static void SetSizeMatriz(int nRow, int nCol)
        {
            matriz = new char[nRow, nCol];

            for (int i = 0; i < nRow; i++)
                for (int j = 0; j < nCol; j++)
                    matriz[i, j] = 'o';
        }
        static void Decision (string line, int cont)
        {
            string[] aux =  line.Split(' ');
            switch (cont)
            {
                case 1: SetSizeMatriz(int.Parse(aux[0]), int.Parse(aux[1]));  break;
                case 2: SetBounds(aux, 'q'); break;
                case 3: SetBounds(aux, 'k'); break;
                case 4: SetBounds(aux, 'p'); AnalizeBoard(); break;
            }
        }
        static void Main(string[] args)
        {
            int cont = 0;
            string [] lines;
            if (File.Exists("queens.in"))
            {
               lines = File.ReadAllLines("queens.in");
               foreach (string line in lines)
               {
                    cont++;
                    if (!(line.Equals("0 0") && cont == 1))
                        Decision(line, cont);
                    else
                        break;

                    if (cont == 4)
                        cont = 0;
               }
            }else
                Console.WriteLine("No se encuentra el archivo en la ruta /ConsoleApp1/bin/Debug/netcoreapp3.1");

            Console.WriteLine("\n\nOprime una tecla para continuar...");
            Console.ReadKey();
        }
    }
}
