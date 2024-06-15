# SNAKE GAME
# Amberly Loh Binti Mohd Azlan Loh
# amberly456loh@gmail.com

# 1. IMPORT
from tkinter import *
import random

# 3. CONSTANTS FOR GAME
GAME_WIDTH = 1000
GAME_HEIGHT = 600
# how often the canvas update, the lower the number the faster the game
SPEED = 120
# how large is the objects
SPACE_SIZE = 35
# snake body parts when begin
BODY_PARTS = 3
SNAKE_COLOR = "gold"
FOOD_COLOR = "#FF0000"
BACKGROUND_COLOR = "#000000"

# 2. FUNCTIONS
# 9.snake
class Snake:
    def __init__(self):
        self.body_size = BODY_PARTS
        self.coordinates = []
        self.squares = []

        # snake will appear at top left corner
        for i in range(0, BODY_PARTS):
            self.coordinates.append([0,0])

        # squares
        for x, y in self.coordinates:
            square = canvas.create_rectangle( x, y, x + SPACE_SIZE, y + SPACE_SIZE, fill = SNAKE_COLOR, tag="snake")
            # append each square to our list
            self.squares.append(square)
# 8. food
class Food:
    def __init__(self):
        x = random.randint(0, (GAME_WIDTH // SPACE_SIZE)- 1) * SPACE_SIZE
        y = random.randint(0, (GAME_HEIGHT // SPACE_SIZE) - 1) * SPACE_SIZE

        self.coordinates = [x, y]
        
        # drawing food object, shaped can be changed (current is oval)
        canvas.create_oval( x, y, x + SPACE_SIZE, y + SPACE_SIZE, fill = FOOD_COLOR, tag = "food")

# 10. next_turn
def next_turn(snake, food):
    x, y = snake.coordinates[0]

    # check if initial direction = to up down left or right
    if direction == "up":
        # so that move one space up
        y -= SPACE_SIZE
    elif direction =="down":
        y += SPACE_SIZE
    elif direction =="left":
        x -= SPACE_SIZE
    elif direction =="right":
        x += SPACE_SIZE

    # insert new coordinate after updating the if else
    snake.coordinates.insert(0, (x,y))

    # graphic for head of snake
    square = canvas.create_rectangle(x, y, x + SPACE_SIZE, y + SPACE_SIZE, fill = SNAKE_COLOR)

    # update snakes list of squares
    snake.squares.insert(0, square)

    # check food if ovelapped with snake
    if x == food.coordinates[0] and y == food.coordinates[1]:
        global score
        score += 1
        label.config(text="Score:{}".format(score))
        canvas.delete("food")
        food = Food()
        
    else: 
    # delete unecessary body part of snake
        del snake.coordinates[-1]
        canvas.delete(snake.squares[-1])
        del snake.squares[-1]
    
    if check_collisions(snake):
        game_over()
    else:
        # calling the next_turn function(just the name) and pass in arguments
        window.after(SPEED, next_turn, snake, food)

# 12. change_direction
def change_direction(new_direction):
    # old direction
    global direction

    if new_direction == 'left':
        # to avoid going opposte way causing 180 degree turn
        if direction != 'right':
            direction = new_direction

    elif new_direction == 'right':
        if direction != 'left':
            direction = new_direction

    elif new_direction == 'up':
        if direction != 'down':
            direction = new_direction

    elif new_direction == 'down':
        if direction != 'up':
            direction = new_direction

# 13. check_collisions
def check_collisions(snake):
    x, y = snake.coordinates[0]
    # check if crosses left or right border of the game
    if x < 0  or x >= GAME_WIDTH:
        return True
    elif y < 0 or y >= GAME_HEIGHT:
        return True
    
    # check if touches tail or body part(everything after snake's head)
    for body_part in snake.coordinates[1:]:
        if x == body_part[0] and y == body_part[1]:
            return True
    return False

# 14. game_over
def game_over():
    canvas.delete(ALL)
    canvas.create_text(canvas.winfo_width()/2, canvas.winfo_height()/2,
                       font = ('consolas',70), text = "GAME OVER", fill = "red", tag = "gameover")

# 4. WINDOW
window = Tk()
window.title("Snake Gmae by Amberly Loh")
# unresizable window
window.resizable(False, False)

# 5. SCORE LABEL
score = 0
direction = 'down'
label = Label(window, text = "Score:{}".format(score), font = ('consolas', 40))
# pack the label
label.pack()

# 6. CANVAS
canvas = Canvas(window, bg = BACKGROUND_COLOR, height = GAME_HEIGHT, width = GAME_WIDTH)
canvas.pack()

# 7. WINDOW LOOP (UPDATE)
# =======================
window.update()
# center the window
window_width = window.winfo_width()
window_height = window.winfo_height()
screen_width = window.winfo_screenwidth()
screen_height = window.winfo_screenheight()
x = int((screen_width/2) - (window_width/2))
y = int((screen_height/2) - (window_height/2))
window.geometry(f"{window_width}x{window_height}+{x}+{y}")

# 11. BINDING KEYS
# ================
window.bind('<Left>', lambda event: change_direction('left'))
window.bind('<Right>', lambda event: change_direction('right'))
window.bind('<Up>', lambda event: change_direction('up'))
window.bind('<Down>', lambda event: change_direction('down'))

#---------------------
#  objects
snake = Snake()
food = Food()

# call function
next_turn(snake, food)

window.mainloop()