using System;
using System.Collections.Generic;
using System.Linq;
using MySql.Data.MySqlClient;
using System.Text;
using System.Threading.Tasks;
using System.Data;

namespace ConsoleApplication3
{
	class Program
	{
		static void Main(string[] args)
		{
			string [,] wordsClues = new string[10,2];
			int[] wordLengths = new int[10];
			string connectionString =
				"Server = localhost;" +
				"Database = crossword;" +
				"User ID=pjansen;" +
				"Password=pKn2043X;" +
				"Pooling=false";
			IDbConnection dbcon;
			dbcon = new MySqlConnection(connectionString);
			dbcon.Open();
			IDbCommand dbcmd = dbcon.CreateCommand();
			string sql =
				"SELECT id, words, clues " +
				"FROM wordsclues";
			dbcmd.CommandText = sql;
			IDataReader reader = dbcmd.ExecuteReader();
			int k = 0;
			while (reader.Read())
			{
				string Word = (string)reader["words"];
				string Clue = (string)reader["clues"];
				wordsClues[k, 0] = Word;
				wordsClues[k, 1] = Clue;
				k++;
			}
			// clean up
			reader.Close();
			reader = null;
			dbcmd.Dispose();
			dbcmd = null;
			dbcon.Close();
			dbcon = null;
			for (int i = 0; i < wordsClues.Length/2; i++)
			{
				wordLengths[i] = wordsClues[i, 0].Length;
			}
			for (int i = 0; i < wordsClues.Length / 2; i++ )
			{
				Console.WriteLine("Word: {0}    Clue: {1}    WordLength: {2}", wordsClues[i, 0], wordsClues[i, 1], wordLengths[i]);
			}
			Console.ReadLine ();


		}
	}
}