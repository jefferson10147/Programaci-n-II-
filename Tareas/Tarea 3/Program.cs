using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;

namespace ConsoleApp1
{
    class Program
    {
        static string[] sentencesFile;
        static bool searchChar(string characterS)
        {
            char characterB = characterS[0];
            char[] abc = {'A','B','C','D','E','F','G',
                        'H','I','J','K','L','M','N',
                        'O','P','Q','R','S','T','U',
                        'V','X','W','Y','Z'};
            int inicio = 0, final = 25, mitad;

            while (inicio <= final)
            {
                mitad = (final + inicio) / 2;

                if (abc[mitad] == characterB)
                    return true;

                if (abc[mitad] > characterB)
                    final = mitad - 1;

                if (abc[mitad] < characterB)
                    inicio = mitad + 1;
            }

            return false;
        }

        static string analizeTags(string sentence)
        {
            string[] words;
            string[] aux;
            string[] aux2;
            words = sentence.Split(' ');
            Stack tagIn = new Stack();
            Queue tagEnd = new Queue();

            foreach (string word in words)
            {
                aux = word.Split('<');

                foreach (string wordS in aux)
                {
                    if (!(wordS.Equals("")))
                    {
                        aux2 = wordS.Split('>');
                        for (int i = 0; i < aux2.Length; i++)
                        {
                            if (!(aux2[i].Equals("")))
                            {
                                if (searchChar(aux2[i].Substring(0, 1)) && aux2[i].Length == 1)
                                    tagIn.Push(aux2[i]);

                                if ((aux2[i].StartsWith('/')) && searchChar(aux2[i].Substring(1, 1)) && aux2[i].Length == 2)
                                    tagEnd.Enqueue(aux2[i]);
                            }
                        }
                    }
                }
            }

            string tagStack = null, tagQueue = null;
            while (tagIn.Count > 0)
            {
                tagStack = (string)tagIn.Pop();

                if (tagEnd.Count != 0)
                {
                    tagQueue = (string)tagEnd.Dequeue();
                    tagQueue = tagQueue.Trim(new Char[] { '/' });
                }
                else
                    return "Expected </" + tagStack + "> Found #";

                if (string.Compare(tagStack, tagQueue) != 0)
                    return "Expected </" + tagStack + "> Found </" + tagQueue + ">";
            }

            if (tagEnd.Count != 0)
                return "Expected # Found <" + tagEnd.Dequeue() + ">";

            return "Correctly tagged paragraph";
        }
        static void createdSentences(string[] textFile)
        {
            int j = 0, sizeSent = 0;

            for (int i = 0; i < textFile.Length - 1; i++)
                if (textFile[i].EndsWith('#'))
                    sizeSent++;

            sentencesFile = new string[sizeSent];

            for (int i = 0; i < (textFile.Length - 1); i++)
            {
                sentencesFile[j] += textFile[i];
                sentencesFile[j] += " ";
                if (textFile[i].EndsWith('#'))
                    j++;
            }
        }
        static void Main(string[] args)
        {

            if (File.Exists("tag.in"))
            {
                string[] textFile = File.ReadAllLines("tag.in");

                Console.WriteLine("Contenido del Archivo:\n");
                for (int i = 0; i < textFile.Length; i++)
                    Console.WriteLine(textFile[i]);

                createdSentences(textFile);
                Console.WriteLine("\n\n");
                for (int i = 0; i < sentencesFile.Length; i++)
                    Console.WriteLine(analizeTags(sentencesFile[i]));
            }
            else
                Console.WriteLine("Error, no se encuentra el archivo en la ruta /ConsoleApp1/bin/Debug/netcoreapp3.1.");

            Console.WriteLine("\n\n-------------\nRealizado por Jeffeson S. Montilla Mendoza \nC.I: 26493551.");
            Console.WriteLine("\n\n\n\nPulse cualquier tecla para continuar...");
            Console.ReadKey();
        }
    }
}
