import MySQLdb
import chess.pgn
import re
import fileinput

db = MySQLdb.connect("localhost","root","","tchess" )
cursor = db.cursor()


#pgn = open( "KingBase2018-A00-A39.pgn",'r', encoding="utf-8-sig" )
pgn = open( "F:\Topic_digital_humanity\pgns\SovietChamp1985.pgn",'r', encoding="utf-8-sig" )

#fi = fileinput.FileInput(openhook=fileinput.hook_encoded("utf-8-sig"))

game = chess.pgn.read_game(pgn)

counter = 0
while (game.errors == []):
    try:
        game = chess.pgn.read_game( pgn )
        event = game.headers["Event"]
        site = game.headers["Site"]
        date = game.headers["Date"]
        pattern = re.compile( '\d+' )
        date_arr = re.findall( pattern, date )
        date = date_arr[0]
        round = game.headers["Round"]
        white = game.headers["White"]
        black = game.headers["Black"]
        result = game.headers["Result"]
        moves_temp = game.main_line()
        moves = (game.board().variation_san( moves_temp ))

    # YEAR
    # EVENT
    # FEN
    # WHITE_NAME
    # BLACK_NAME
    # RESULT

    except Exception:
        continue
    query = """
             INSERT INTO old_games (EVENT,YEAR,RESULT,WHITE_NAME,BLACK_NAME,FEN)
             VALUES
                 ('%s', '%s','%s', '%s','%s', '%s')
             """%\
             (event,date,result,white,black,moves)
    cursor.execute(query)
    counter += 1
    print(counter)

print(counter)