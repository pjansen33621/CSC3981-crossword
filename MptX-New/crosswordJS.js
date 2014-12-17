/**
 * Created by Ty on 12/16/2014.
 */

var data = [
    {
        id:     1,
        word:   'test',
        def:    'test1'
    },{
        id:     2,
        word:   'soleil',
        def:    'étoile de notre système'
    }
    ,{
        id:     3,
        word:   'soleil',
        def:    'étoile de notre système'
    }
]

$(document).ready(function(){
    $("#main").data('crosswords', data)
        .crosswordable() ;

    $("#submit").click(function(event){
        console.log($("#main").crosswordable('serialize')) ;
    })
}) ;