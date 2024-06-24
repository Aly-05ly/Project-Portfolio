# 1. IMPORT
# handle connection to server
import socket
from _thread import *
from game import Game
import pickle

# 2. DEFINITIONS
server = "192.168.0.7" #address
port = 5555

# 3. CREATE SOCKET
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# 4. BIND PORT AND SERVER TO SOCKET
try:
    s.bind((server, port))
except socket.error as e:
    str(e)

# 5. LISTEN FOR CONNECTIONS
# open up the port if () blank then allow unlimited amount of connection
s.listen(2)
print("Waiting for connection, Server Started")

# store ip address of connected client
connected = set()
# dictionary store our game
games = {}
# keep track of current id so games with same id wont hapen , might cause overwrite
idCount = 0

# 6. THREADED CLIENT
def threaded_client(conn, p, gameId):
    global idCount
    conn.send(str.encode(str(p)))

    reply = ""
    while True:
        try:
            data = conn.recv(4096*8).decode()

            if gameId in games:
                game = games[gameId]

                if not data:
                    break
                else:
                    if data == "reset":
                        game.resetWent()
                    elif data != "get":
                        game.play(p, data)
                    reply = game
                    conn.sendall(pickle.dumps(game))

            else:
                break
        except:
            break

    print("Lost connection")
    
    try:
        del games[gameId]
        print("Closing Game", gameId)
    except:
        pass
    idCount -= 1
    conn.close

while True:
    conn, addr = s.accept()
    print("Connected to:", addr)
    
    idCount += 1
    p = 0
    # every two people connect to server, id count inc by one, game id track how many games currently
    gameId = (idCount - 1)//2
    # player 1 & 2 pair (if odd, create new game)
    if idCount % 2 == 1:
        games[gameId] = Game(gameId)
        print("Creating a new game...")
    else:
        games[gameId].ready = True
        p = 1

    start_new_thread(threaded_client,(conn, p, gameId))
