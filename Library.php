<?php

class Library
{

    public function countBooks()
    {
        $count = DB::query('SELECT COUNT(*) as count FROM book');
        return "Il y a $count->count livres dans la librairie.";
    }

    public function countWriters()
    {
        $count = DB::query('SELECT COUNT(*) as count FROM writer');
        return "Il y a $count->count auteurs enregistrés dans la librairie.";
    }

    public function getBooksByKind($kind){

        $books = DB::query('SELECT * from book where kind = :kind', ['kind' => $kind]);

        $view = '
        <table>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>kind</th>
                <th>published_at</th>
                <th>actions</th>
            </tr>';

        if(is_array($books)){

            foreach ($books as $book) {
                $view .= "
            <tr>
                <td>$book->id</td>
                <td>$book->title</td>
                <td>$book->kind</td>
                <td>$book->published_at</td>
                <td>
                    <form method='POST'>
                    <button name='edit' value='$book->id'>Modifier</button>
                    <button name='delete' value='$book->id'>Supprimer</button>
                    </form>
                    </td>
                    </tr>
                    ";
            }
                
                $view .= '</table>';
                
                return $view;
        }else{
                $view .= "
                <tr>
                    <td>$books->id</td>
                    <td>$books->title</td>
                    <td>$books->kind</td>
                    <td>$books->published_at</td>
                    <td>
                        <form method='POST'>
                        <button name='edit' value='$books->id'>Modifier</button>
                        <button name='delete' value='$books->id'>Supprimer</button>
                        </form>
                        </td>
                        </tr>
                        ";
                        
                $view .= '</table>';
                return $view;
        }
                
    
    }

    public function getBooksWrittenBefore($year){
        $books = DB::query('SELECT * from book where YEAR(published_at) <= :year', ['year' => $year]);

        $view = '
        <table>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>kind</th>
                <th>published_at</th>
                <th>actions</th>
            </tr>';

        if(is_array($books)){

            foreach ($books as $book) {
                $view .= "
                <tr>
                    <td>$book->id</td>
                    <td>$book->title</td>
                    <td>$book->kind</td>
                    <td>$book->published_at</td>
                    <td>
                        <form method='POST'>
                        <button name='edit' value='$book->id'>Modifier</button>
                        <button name='delete' value='$book->id'>Supprimer</button>
                        </form>
                    </td>
                </tr>
            ";
            }
                
                $view .= '</table>';
                
                return $view;
        }else{
                $view .= "
                <tr>
                    <td>$books->id</td>
                    <td>$books->title</td>
                    <td>$books->kind</td>
                    <td>$books->published_at</td>
                    <td>
                        <form method='POST'>
                        <button name='edit' value='$books->id'>Modifier</button>
                        <button name='delete' value='$books->id'>Supprimer</button>
                        </form>
                        </td>
                        </tr>
                        ";
                        
                $view .= '</table>';
                return $view;
        }
    }

    public function getBooksWrittenBy($writer){

        $books = DB::query('SELECT * from book 
        INNER JOIN writer_write_book ON book.id = writer_write_book.book_id
        INNER JOIN writer where lastname LIKE :lastname OR firstname LIKE :firstname 
        ', ['lastname'=> $writer, 'firstname'=>$writer]);

        //$writers = DB::query('SELECT * from writer where lastname LIKE :lastname OR firstname LIKE :firstname', ['lastname'=> $writer, 'firstname'=>$writer]);

        var_dump($books);
        

    }
}
