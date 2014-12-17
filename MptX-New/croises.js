Crossword = function(JPaper, data) {
    this.setJPaper(JPaper) ;
    this.setData(data) ;
}

Crossword.prototype = {
    JPaper: null,
    data:   null,
    prevOrientation: null,

    setData: function(data) {
        this.data = this.sortData(data) ;
        this.newGrid(20) ;

        var word = this.data[0],
            nbWords = this.data.length ;

        word.orientation = 'vertical' ;
        word.incrRow = 1 ;
        word.incrCol = 0 ;
        word.row = 6 ;
        word.col = 6 ;
        this.markGrid(word, 0) ;

        for (var iWord = 1 ; iWord < nbWords ; iWord++) {

            var dataWord = this.data[iWord],
                word = dataWord.word,
                notPlaced = true ;

            for (var iWordOnGrid = 0 ; iWordOnGrid < iWord && notPlaced ; iWordOnGrid++) {
                var dataWordOnGrid = this.data[iWordOnGrid],
                    wordOnGrid = dataWordOnGrid.word,
                    commonLetters = [] ;

                for (var iLetter = 0 ; iLetter < word.length ; iLetter++) {
                    for (var iLetter2 = 0 ; iLetter2 < wordOnGrid.length ; iLetter2++) {
                        if (word[iLetter] == wordOnGrid[iLetter2])
                            commonLetters.push([iLetter2, iLetter, word[iLetter]]) ;
                    }
                }
            
                /*
                console.log(word + ' vs. ' + wordOnGrid + ' : ' + commonLetters) ;
                this.showGrid() ;
                */

                for (var iCommon = 0 ; iCommon < commonLetters.length && notPlaced; iCommon++) {
                    var intersection = commonLetters[iCommon] ;

                    dataWord.orientation = this.inverse[dataWordOnGrid.orientation] ;
                    dataWord.incrRow = dataWordOnGrid.incrCol ;
                    dataWord.incrCol = dataWordOnGrid.incrRow ;

                    dataWord.row = dataWordOnGrid.row
                                   + intersection[0]*dataWordOnGrid.incrRow
                                   - intersection[1]*dataWord.incrRow ;
                    dataWord.col = dataWordOnGrid.col
                                   + intersection[0]*dataWordOnGrid.incrCol
                                   - intersection[1]*dataWord.incrCol ;

                    if (this.checkCollision(dataWord, intersection)) {
                        this.markGrid(this.data[iWord], iWord) ;
                        notPlaced = false ;
                    }
                }
            }
        }

        this.addNumbers() ;
    },

    checkCollision: function(dWord, intersection) {
        var letterCount = dWord.word.length,
            onGrid = '',
            row = dWord.row,
            col = dWord.col ;

        // word check
            row = dWord.row ;
            col = dWord.col ;
            for (var iLetter = 0 ; iLetter < letterCount; iLetter++) {
                onGrid = this.grid[row][col] ;
                if (onGrid[0] != '.' && onGrid[0] != dWord.word[iLetter]) {
                    return false ;
                }
                row += dWord.incrRow ;
                col += dWord.incrCol ;
            }

        // end check
            row = dWord.row+dWord.word.length*dWord.incrRow ;
            col = dWord.col+dWord.word.length*dWord.incrCol ;
            onGrid = this.grid[row][col] ;
            if (onGrid[0] != '.') {
                return false ;
            }

        // start check
            row = dWord.row-dWord.incrRow ;
            col = dWord.col-dWord.incrCol ;
            onGrid = this.grid[row][col] ;
            if (onGrid[0] != '.') {
                return false ;
            }

        // border check
            row = dWord.row + dWord.incrCol ;
            col = dWord.col + dWord.incrRow ;
            for (var iLetter = 0 ; iLetter < letterCount; iLetter++) {
                if (iLetter != intersection[1]) {
                    onGrid = this.grid[row][col] ;
                    if (onGrid[0] != '.') {
                        return false ;
                    }
                }
                row += dWord.incrRow ;
                col += dWord.incrCol ;
            }
            row = dWord.row - dWord.incrCol ;
            col = dWord.col - dWord.incrRow ;
            for (var iLetter = 0 ; iLetter < letterCount; iLetter++) {
                if (iLetter != intersection[1]) {
                    onGrid = this.grid[row][col] ;
                    if (onGrid[0] != '.') {
                        return false ;
                    }
                }
                row += dWord.incrRow ;
                col += dWord.incrCol ;
            }

        return true ;
    },

    sortData: function(data) {
        return data.sort(function(a, b) {
            return - (a.word.length - b.word.length) ;
        }) ;
    },

    inverse: {
        'horizontal': 'vertical',
        'vertical':   'horizontal'
    },

    newGrid: function(n) {
        this.grid = [] ;
        for (var iRow = 0 ; iRow < n ; iRow++) {
            this.grid[iRow] = [] ;
            for (var iCol = 0 ; iCol < n ; iCol++) {
                this.grid[iRow][iCol] = ['.', -1] ;
            }
        }
    },

    markGrid: function(word, iWord) {
        var letterCount = word.word.length,
            incrCol = 0,
            incrRow = 0 ;
        switch (word.orientation) {
            case 'horizontal':
                incrCol++ ;
                break ;
            case 'vertical':
                incrRow++ ;
                break ;
        }

        var row = 0,
            col = 0 ;
        for (var iLetter = 0 ; iLetter < letterCount ; iLetter++) {
            row = word.row+iLetter*incrRow ;
            col = word.col+iLetter*incrCol ;
            if (this.grid[row][col][0] == '.') {
                this.grid[row][col] = [word.word[iLetter], iWord] ;
            } else {
                this.grid[row][col][1] = -1 ; // an intersection
            }
        }
    },

    showGrid: function() {
        var res = '' ;
        for (var iRow = 0 ; iRow < this.grid.length ; iRow++) {
            for (var iCol = 0 ; iCol < this.grid[iRow].length ; iCol++) {
                res += this.grid[iRow][iCol][0] + ' ' ;
            }
            res += '\n' ;
        }
        console.log(res) ;
    },

    setJPaper: function(JPaper) {
        this.JPaper = JPaper ;
    },

    addNumbers: function() {
        var iHorizontal = 0,
            iVertical = 0 ;

        for (var iWord = 0 ; iWord < this.data.length ; iWord++) {
            var word = this.data[iWord],
                row = word.row - word.incrRow,
                col = word.col - word.incrCol ;

            var res = null ;
            if (word.incrRow == 1) { // vertical
                res = String.fromCharCode(65+iVertical) ;
                iVertical++ ;
            } else {
                res = iHorizontal+1 ;
                iHorizontal++ ;
            }

            this.grid[row][col][0] = res ;
            this.grid[row][col][1] = -2 ;
        }
    },

    addDefs: function() {
        var htmlVertical = '<ol id="crossword-vertical-defs">',
            htmlHorizontal = '<ol id="crossword-horizontal-defs">' ;
        
        for (var iWord = 0 ; iWord < this.data.length ; iWord++) {
            var word = this.data[iWord] ;

            var res = null ;
            if (word.incrRow == 1) {
                htmlVertical += '<li>' + word.def + '</li>' ;
            } else {
                htmlHorizontal += '<li>' + word.def + '</li>' ;
            }
        }  

        htmlVertical += '</ol>' ;
        htmlHorizontal += '</ol>' ;

        this.JPaper.append(htmlVertical) ;
        this.JPaper.append(htmlHorizontal) ;
    },

    createGrid: function() {
        var html = '<table id="crossword-grid" class="crosswords">' ;

        for (var iRow = 0 ; iRow < this.grid.length ; iRow++) {
            html += '<tr rowID="'+iRow+'">' ;
            for (var iCol = 0 ; iCol < this.grid[iRow].length ; iCol++) {
                var currCell = this.grid[iRow][iCol] ;

                var content = '' ;
                if (currCell[0] != '.') {
                    switch (currCell[1]) {
                        case -2:
                            content = currCell[0] ;
                            break ;

                        case -1:
                            content = '<input type="text" colID="'+iCol+'" dir="none"/>' ;
                            break ;

                        default:
                            content = '<input type="text"  colID="'+iCol+'" dir="'+this.data[currCell[1]].orientation+'"/>' ;
                            break ;
                    }
                }

                html += '\
                    <td> \
                        '+content+' \
                    </td>' ;
            }
            html += '</tr>' ;
        }

        html += '</table>' ;

        this.JPaper.append(html) ;
        this.JGrid = $('#crossword-grid') ;
    },

    attachEvents: function() {
        var self = this ;

        this.JGrid.find('input').keydown(function(event){
            var rowID = $(this).parent().parent().attr('rowID'),
                colID = $(this).attr('colID'),
                orientation = $(this).attr('dir') ;

            if (event.which >= 37 && event.which <= 40) {
                switch (event.which) {
                    case 37: // left
                        colID-- ;
                        break ;
                    case 38: // up
                        rowID-- ;
                        break ;
                    case 39: // right
                        colID++ ;
                        break ;
                    case 40: // bottom
                        rowID++ ;
                        break ;
                }
            } else if (event.which >= 65 && event.which <= 90) {
                $(this).val(String.fromCharCode(event.which)) ;
                switch (orientation) {
                    case 'horizontal':
                        colID++ ;
                        break ;
                    case 'vertical':
                        rowID++ ;
                        break ;
                    case 'none':
                        if (self.prevOrientation != null) {
                            switch (self.prevOrientation) {
                                case 'horizontal':
                                    colID++ ;
                                    break ;
                                case 'vertical':
                                    rowID++ ;
                                    break ;
                            }
                        } else {
                            colID++ ;
                        }
                        break ;
                }
            } else if (event.which == 8) {
                $(this).val('') ;
                switch (orientation) {
                    case 'horizontal':
                        colID-- ;
                        break ;
                    case 'vertical':
                        rowID-- ;
                        break ;
                    case 'none':
                        if (self.prevOrientation != null) {
                            switch (self.prevOrientation) {
                                case 'horizontal':
                                    colID-- ;
                                    break ;
                                case 'vertical':
                                    rowID-- ;
                                    break ;
                            }
                        } else {
                            colID++ ;
                        }
                        break ;
                }
            }

            $('tr[rowID='+rowID+'] input[colID='+colID+']').focus() ;
            
            self.prevOrientation = orientation ;

            event.preventDefault() ;
        }) ;
    }
}

$.fn.crosswordable = function(options){
    if (options == 'serialize') {
        var data = $(this).data('crosswords'),
            answers = '',
            firstAnswer = true ;

        for (var iWord = 0 ; iWord < data.length ; iWord++) {
            var dataWord = data[iWord],
                letterCount = dataWord.word.length,
                res = '' ;

            var row = dataWord.row,
                col = dataWord.col ;
            for (var iLetter = 0 ; iLetter < letterCount ; iLetter++) {
                res += $('tr[rowID='+row+'] input[colID='+col+']').val() ;
                row += dataWord.incrRow ;
                col += dataWord.incrCol ;
            }

            (firstAnswer) ? firstAnswer = false : answers += '&' ;
            answers += "crosswords["+dataWord.id+']='+res ;
        }

        return answers ;
    } else {
        var data = $(this).data('crosswords') ;

        var cw = new Crossword($(this), data) ;
        cw.addDefs() ;
        cw.createGrid() ;
        cw.attachEvents() ;

        $(this).data('crosswords', cw.data) ;
    }
}
