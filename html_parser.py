import MySQLdb
from html.parser import HTMLParser
import re

class MyHTMLParser(HTMLParser):

    def __init__(self):
        HTMLParser.__init__( self )
        self.db = MySQLdb.connect( "localhost", "root", "", "tchess" )
        self.cursor = self.db.cursor()

    # def handle_starttag(self, tag, attrs):
    #     print("Encountered a start tag:", tag)
    #
    # def handle_endtag(self, tag):
    #     print("Encountered an end tag :", tag)
    CATEGORY = ''
    NAME = ''
    FEN = ''

    def handle_data(self, data):
        if ('EventListener'  in data or 'ElementsByTagName' in data or 'Francesco' in data or 'Home' in data or 'Links' in data  or '=' in data):
            pass
        else:

            filterred_data = data.replace("\n", " ")
            filterred_data = filterred_data.replace( "\'", "" )
            filterred_data = filterred_data.replace( "&amp", "" )
            filterred_data = filterred_data.replace(' - '," ")
            FEN_RE = '(\d.\w{1,2}\d\s\w{1,2}\d.{0,})+'
            NAME_RE = '[A-Z]{1}[a-z]{3,}[\s\D+]*'
            match = re.search(NAME_RE, filterred_data)
            match_fen = re.search(FEN_RE, filterred_data)
            if match:
                self.NAME = match.string[match.start():match.end()]
                if self.NAME == 'Kings Pawn Game' or self.NAME =='Semi Open Game'or self.NAME =='Queens Pawn Game'or self.NAME =='Indian Defences' or self.NAME == 'Unusual First Move':
                    self.CATEGORY = self.NAME
                else:
                    pass
                    #print( "Encountered some data  :", match.string[match.start():match.end()] )
            if match_fen:
                self.FEN = match_fen.string[match_fen.start():match_fen.end()]
                self.FEN= self.FEN.replace( '.', '. ' )

                #print( "Encountered some data  :", match_fen.string[match_fen.start():match_fen.end()] )
                if(self.NAME != 'Kings Pawn Game'):
                    query = """ INSERT INTO openings_test (NAME,CATEGORY,FEN)
                                 VALUES
                                ('%s', '%s','%s')
                                """%\
                     (self.NAME,self.CATEGORY,self.FEN)
                    self.cursor.execute(query)
                    #print(self.CATEGORY)
                    #print(self.NAME)
                    #print(self.FEN)



parser = MyHTMLParser()
f=open("F:\Topic_digital_humanity\CHESS OPENING DATA BASE.html","r")
s=f.read()
parser = MyHTMLParser()
parser.feed(s)
