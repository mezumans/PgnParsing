import pywikibot
import MySQLdb
from pywikibot.exceptions import (
    AutoblockUser,
    NotEmailableError,
    SiteDefinitionError,
    UserRightsError,
    NoPage
)

def convert_name(origin_name):
    Last = origin_name.split( ',' )[0]
    first = origin_name.split( ',' )[1]
    name = first[1:] + " " + Last
    return name

def alter_white_country():
    db = MySQLdb.connect( "localhost", "root", "", "tchess" )
    cursor = db.cursor()
    query = """UPDATE game
            SET WHITE_COUNTRY = %s WHERE WHITE_NAME = %s ;"""
    a = get_names()
    res_list = [x[0] for x in a]
    for player in res_list:
        if player != None:
            print (player)
            player_name = convert_name( player )
            country = get_country(player_name)
            if country:
                cursor.execute(query,(country,player))

    cursor.close()
    db.close()

def get_names():
    db = MySQLdb.connect( "localhost", "root", "", "tchess" )
    cursor = db.cursor()
    ans = []
    cursor.execute( "SELECT WHITE_NAME FROM game GROUP by WHITE_NAME" )
    result_set = cursor.fetchall()
    return result_set



def get_country(player_name):
    site = pywikibot.Site( "en", "wikipedia" )
    page = pywikibot.Page( site, player_name )
    try:
        item = pywikibot.ItemPage.fromPage( page )
    except NoPage:
        return 'World citizen'


    repo = site.data_repository()
    item_dict = item.get()
    clm_dict = item_dict["claims"]
    if "P27" in clm_dict:
        clm_list = clm_dict["P27"]
    else : return None

    for clm in clm_list:
        a = clm.toJSON()
        numeric_id = a["mainsnak"]["datavalue"]["value"]["numeric-id"]
        wdt = "Q"+str(numeric_id)
        country_item = pywikibot.ItemPage(repo, wdt)
        country_dict = country_item.get()
        country = country_dict["labels"]['en']


    return country