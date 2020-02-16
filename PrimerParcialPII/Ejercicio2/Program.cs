using System;
using System.IO;

namespace ejercicio_2
{
    class Program
    {
        static char [] vowelList = { 'a', 'e', 'i', 'o', 'u' };
        static char[] consonantList = { 'b','c','d','f','g','h','j','k','l','m','n',
                                        'p','q','r','s','t','v','x','w','y','z' };
        static bool isVowel (char letter)
        {
            for (int i = 0; i < vowelList.Length; i++)
                if (vowelList[i] == letter)
                    return true;
         
            return false;
        }
        static bool isConsonant(char letter)
        {
            for (int i = 0; i < consonantList.Length; i++)
                if (consonantList[i] == letter)
                    return true;

            return false;
        }

        static bool consecutiveLetters(string word)
        {
            for (int i = 0; i < (word.Length-2); i++)
            {
                if (isConsonant(Char.Parse(word.Substring(i, 1))) && isConsonant(Char.Parse(word.Substring(i + 1, 1))) && isConsonant(Char.Parse(word.Substring(i + 2, 1))))
                    return false;

                if (isVowel(Char.Parse(word.Substring(i, 1))) && isVowel(Char.Parse(word.Substring(i + 1, 1))) && isVowel(Char.Parse(word.Substring(i + 2, 1))))
                    return false;
            }
            return true;
        }

        static bool sameTwoLetters(string word)
        {
            char c1, c2;
            for (int i = 0; i < word.Length - 1; i++)
            {
                c1 = Char.Parse(word.Substring(i, 1));
                c2 = Char.Parse(word.Substring(i + 1, 1));
                if (c1 == c2)
                    if (c1 != 'e' && c2 != 'e')
                        if (c1 != 'o' && c2 != 'o')
                            return false;
            }
            return true;
        }
        static string analyzeWord (string word)
        {
            bool cond1 = false, cond2 = false, cond3 = false;
            for (int i = 0; i < word.Length; i++)
            {
                if (isVowel(Char.Parse(word.Substring(i, 1))))
                {
                    cond1 = true;
                    if (word.Length == 1)
                        return "<"+word+"> is acceptable.";
                }
            }
            if (word.Length >= 3)
                cond2 = consecutiveLetters(word);

            if (word.Length >= 2)
            {
                cond3 = sameTwoLetters(word);
                if (word.Length == 2 && cond1 && cond3)
                    return "<" + word + "> is acceptable.";
            }

            if (cond1 && cond2 && cond3)
                return "<" + word + "> is acceptable.";

            return "<"+word+"> is not acceptable.";
        }
        static void Main(string[] args)
        {
            if (File.Exists("facil.in"))
            {
                string[] words = File.ReadAllLines("facil.in");
                for (int i = 0; i < (words.Length-1); i++)
                    Console.WriteLine(""+analyzeWord(words[i]));

                Console.WriteLine("\n\nPRESIONA CUALQUIER TECLA PARA CONTINUAR");
                Console.ReadKey();
            }
            else
                Console.WriteLine("No se ha encontrado el archivo.");
        }
    }
}
