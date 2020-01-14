using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;


namespace segundoProyecto
{
    class Program
    {

        public static void imprimir(String[] vFrase)
        {
            for (int i = 0; i < vFrase.Length; i++)
                Console.Write(vFrase[i] + " ");

            Console.WriteLine();
        }
        public static void cambio(String[] vDic, String[] vFrase)
        {
            int contAciertos = 0;
            int[] vAux = new int[vFrase.Length];

            for (int i = 0; i < vFrase.Length; i++)
                vAux[i] = 0;

            for (int i = 0; i < vDic.Length; i++)
            {
                for (int j = 0; j < vFrase.Length; j++)
                {
                    if (vDic[i].Substring(0, 1) == vFrase[j].Substring(0, 1))
                    {
                        if (vDic[i].Substring(vDic[i].Length - 1, 1) == vFrase[j].Substring(vFrase[j].Length - 1, 1))
                        {
                            contAciertos = 0;
                            for (int w = 1; w < vDic[i].Length - 1; w++)
                            {
                                for (int z = 1; z < vFrase[j].Length - 1; z++)
                                {
                                    if (vDic[i].Substring(w, 1) == vFrase[j].Substring(z, 1))
                                    {
                                        contAciertos++;
                                        break;
                                    }
                                }
                            }
                            if ((contAciertos + 2) == vFrase[j].Length)
                            {
                                if (vAux[j] == 0)
                                {
                                    vFrase[j] = vDic[i];
                                    vAux[j] = 1;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            imprimir(vFrase);
            vAux = null;
        }
        static void Main(string[] args)
        {
            string[] lines = File.ReadAllLines("reordenando.in");
            int x = Int32.Parse(lines[0]), cont = 1;
            String[] vDic = new String[200];
            String[] vFrase = new String[200];
            char[] ar = new char[1];
            

            while (cont <= (x * 2))
            {
                if (cont % 2 != 0)
                {
                    vDic = lines[cont].Split(' ');
                }
                else
                {
                    vFrase = lines[cont].Split(' ');
                    cambio(vDic, vFrase);
                }
                cont++;
                
            }
            Console.WriteLine("\n\n\nPULSE UNA TECLA PARA FINALIZAR.");
            Console.ReadLine();
        }
    }
}
