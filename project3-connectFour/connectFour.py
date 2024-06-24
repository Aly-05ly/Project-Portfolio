# Amberly Loh Binti Mohd Azlan loh
# amberly456loh@gmail.com

# 1. IMPORT
import numpy as np
import math
# graphic
import pygame
# exit
import sys

ROW_COUNT = 6
COLUMN_COUNT = 7
# red, green, blue
BLUE = (0,0,255)
BLACK = (0,0,0)
RED = (255,0,0)
YELLOW = (255,255,0)

# 2. CREATE BOARD
def create_board():
    # 6 rows 7 line
    board = np.zeros((ROW_COUNT,COLUMN_COUNT))
    return board

# 5. DROP PIECE
def drop_piece(board, row, col, piece):
    # fill in board with piece dropped by player
    board[row][col] = piece

# 6. VALID LOCATION
def is_valid_location(board, col):
    # to check if valid is when the top row is not filled (5th row)
    return board[ROW_COUNT-1][col] == 0

# 6. GET NEXT OPEN ROW
def get_next_open_row(board, col):
    # check which row the piece will fall upon
    for r in range(ROW_COUNT):
        # if row empty then return row
        if board[r][col] == 0:
            return r

# to get the correct way of board bottom up
def print_board(board):
    # numoy command
    print(np.flip(board, 0))

# 7. CHECK WIN
def winning_move(board, piece):
    # check horizontal location for win
    # loop col and row so it wont go over row col limit
    # subtract 3 because 3 couldnt actually work
    for c in range(COLUMN_COUNT-3):
        for r in range(ROW_COUNT):
            # c+1 to check the next one to the right
            if board[r][c] == piece and board[r][c+1] and board[r][c+2] == piece and board[r][c+3] == piece:
                return True
            
     # vertical loacation for win
    for c in range(COLUMN_COUNT):
        for r in range(ROW_COUNT-3):
            # c+1 to check the next one to the right
            if board[r][c] == piece and board[r+1][c] and board[r+2][c] == piece and board[r+3][c] == piece:
                return True
            
    # check positively sloped diagonals
    for c in range(COLUMN_COUNT-3):
        for r in range(ROW_COUNT-3):
            # c+1 to check the next one to the right
            if board[r][c] == piece and board[r+1][c+1] and board[r+2][c+2] == piece and board[r+3][c+3] == piece:
                return True
            
    # check negatively sloped diagonals (start at third 3rd index)
    for c in range(COLUMN_COUNT-3):
        for r in range(3, ROW_COUNT):
            # c+1 to check the next one to the right
            if board[r][c] == piece and board[r-1][c+1] and board[r-2][c+2] == piece and board[r-3][c+3] == piece:
                return True   

# 10. DRAW BOARD    
def draw_board(board): 
    for c in range(COLUMN_COUNT):
        for r in range(ROW_COUNT):
            # draw on rectangle on screen(screen, color, top left corner, position on y axis, height, width)
            pygame.draw.rect(screen, BLUE, (c*SQUARESIZE, r*SQUARESIZE+SQUARESIZE, SQUARESIZE, SQUARESIZE))
            # draw circles (pygame only accepts integer. sp make all int)
            pygame.draw.circle(screen, BLACK, (int(c*SQUARESIZE+SQUARESIZE/2), int(r*SQUARESIZE+SQUARESIZE+SQUARESIZE/2)), RADIUS)
            
    for c in range(COLUMN_COUNT):
        for r in range(ROW_COUNT):           
            if board[r][c] == 1:
                pygame.draw.circle(screen, RED, (int(c*SQUARESIZE+SQUARESIZE/2), height-int(r*SQUARESIZE+SQUARESIZE/2)), RADIUS)
            elif board[r][c] == 2:
                pygame.draw.circle(screen, YELLOW, (int(c*SQUARESIZE+SQUARESIZE/2), height-int(r*SQUARESIZE+SQUARESIZE/2)), RADIUS)

    pygame.display.update()        

# 3. ASSIGN
board = create_board()
print_board(board)
game_over = False
turn = 0

# 8. CREATE GRAPHICS-INITIALIZE PYGAME
pygame.init()
SQUARESIZE = 100
# define screen size
width = COLUMN_COUNT * SQUARESIZE
height = ( ROW_COUNT + 1 ) * SQUARESIZE

# package
size = (width, height)

RADIUS = int(SQUARESIZE/2 - 5)

screen = pygame.display.set_mode(size)
draw_board(board)
pygame.display.update()

# win sentence
myfont = pygame.font.SysFont("monospace", 75)

# 4. ASK FOR SELECTIONS
# game will run as long as it is false(not 4 in a row)
while not game_over:

    # 9. EXIT
    for event in pygame.event.get():
        # exit by clicking exit button (x)
        if event.type == pygame.QUIT:
            sys.exit()

        # 11.MOUSE MOTION
        if event.type == pygame.MOUSEMOTION:
            # so that itll be correct shaped circle and not one bar of yellow/red line
            pygame.draw.rect(screen, BLACK, (0,0,width,SQUARESIZE))
            posx = event.pos[0]
            # player 1
            if turn == 0:
                pygame.draw.circle(screen, RED, (posx, int(SQUARESIZE/2)), RADIUS)
            else:
                # player 2
                pygame.draw.circle(screen, YELLOW, (posx, int(SQUARESIZE/2)), RADIUS)
        pygame.display.update()    

        # 10. MOUSE BUTTON DOWN
        # drop piece by clicking down
        if event.type == pygame.MOUSEBUTTONDOWN:
            pygame.draw.rect(screen, BLACK, (0,0,width,SQUARESIZE))
            # print(event.pos)
            # Ask for Player 1 Input
            if turn == 0:
                posx = event.pos[0]
                # floor to get int
                col = int(math.floor(posx/SQUARESIZE))

                if is_valid_location(board, col):
                    row = get_next_open_row(board, col)
                    drop_piece(board, row, col, 1)

                    if winning_move(board, 1):
                        # 1 is axis and player 1 so its red
                        label = myfont.render("player 1 wins!", 1, RED)
                        # update specific part of the screen to print the win(or can use pygame.display.update())
                        screen.blit(label, (40,10))
                        game_over = True

            # # Ask for Player 2 input
            else:
                pox = event.pos[0]
                col = int(math.floor(posx/SQUARESIZE))

                if is_valid_location(board, col):
                    row = get_next_open_row(board, col)
                    drop_piece(board, row, col, 2)

                    if winning_move(board, 2):
                        label = myfont.render("player 2 wins!", 1, YELLOW)
                        # update specific part of the screen to print the win(or can use pygame.display.update())
                        screen.blit(label, (40,10))
                        game_over = True

            print_board(board)
            draw_board(board)
            # increase turn by one after each input
            turn += 1
            # odd even so itll alternate zero and one which is player 1 and player 2
            turn = turn % 2

            if game_over:
                # shut down in 3 secs if win
                pygame.time.wait(3000)
    
    