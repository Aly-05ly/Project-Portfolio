# Amberly Loh Binti Mohd Azlan Loh
# amberly456loh@gmail.com
# ================================================================== #

# using TURTLE MODULE-allow graphics for games, instead of pygame
import turtle 
# adding SOUND
# import os -for mac/linux
import winsound

# 1. CREATING WINDOW
# ---------------
# variableName = settings
wn = turtle.Screen()
wn.title("Ping Pong by Amberly Loh")
wn.bgcolor("black")
wn.setup(width=800, height=600)
# stops window from updating - to speed up game
wn.tracer(1)

# 2. CREATING OBJECTS: PADDLE A, PADDLE B, BALL
# ------------------------------------------
# PADDLE A
# name = modulename.Classname()
paddle_a = turtle.Turtle()
# setting speed to max ,shape, color , size, penup(no drawing line when it moves),start coordiante of paddle a
paddle_a.speed(0) 
paddle_a.shape("square")
paddle_a.color("darkred")
paddle_a.shapesize(stretch_wid=5,stretch_len=1)
paddle_a.penup()
paddle_a.goto(-350,0)

# PADDLE B
paddle_b = turtle.Turtle()
paddle_b.speed(0) 
paddle_b.shape("square")
paddle_b.color("darkmagenta")
paddle_b.shapesize(stretch_wid=5,stretch_len=1)
paddle_b.penup()
paddle_b.goto(350,0)

# BALL
ball = turtle.Turtle()
ball.speed(0) 
ball.shape("circle")
ball.color("gold")
ball.penup()
ball.goto(0,0)
# To move the ball: dx means delta or change. so, var.dx = 2. Means everytime ball moves, it moves by 2 px
ball.dx = 2
ball.dy = -2

# PEN
pen = turtle.Turtle()
# animation speed, color, penup, hide it bcs we only want to see the score, coordinate and text of score
pen.speed(0)
pen.color("darkorange")
pen.penup()
pen.hideturtle()
pen.goto(0,260)
pen.write("Player A: 0  Player B: 0  ", align="center", font=("Courier", 24, "bold"))

# SCORE
score_a = 0
score_b = 0

# 4. MOVING THE OBJECTS
# ------------------
# FUNCTION - moving paddles
def paddle_a_up():
    # coordinates: increases up add 20px to y coordinates. value reassigned to paddle_a.setY() 
    y = paddle_a.ycor()
    y +=20
    paddle_a.sety(y)

def paddle_a_down():
    # coordinates: decreases down add 20px to y coordinates. value reassigned to paddle_a.setY() 
    y = paddle_a.ycor()
    y -=20
    paddle_a.sety(y)

def paddle_b_up():
    y = paddle_b.ycor()
    y +=20
    paddle_b.sety(y)

def paddle_b_down():
    y = paddle_b.ycor()
    y -=20
    paddle_b.sety(y)

# KEYBOARD BINDING
# listen to keyboard input,when user press "w" , call the function paddle_a_up, increase 20px, and assign value (FUNCTION: paddle_a_up)
wn.listen()
# using w & s
wn.onkeypress(paddle_a_up,"w")
wn.onkeypress(paddle_a_down,"s")
# using up & down *ARROW*
wn.onkeypress(paddle_b_up,"Up")
wn.onkeypress(paddle_b_down,"Down")

# 3. MAIN GAME LOOP - everytime loop's done, it updates the game
# -----------------------------------------------------------
while True:
    wn.update()

    # MOVE THE BALL: ball starts 0,0 and goes through the loop it moves 2px
    ball.setx(ball.xcor() + ball.dx)
    ball.sety(ball.ycor() + ball.dy)

    # BORDER CHECKING
    # bounce once get to a certain point

    # top border
    if ball.ycor() > 290:
        ball.sety(290)
        # reverse direction of the ball
        ball.dy *= -1
        # SOUND
        # af for mac, a for linux, & so it doesnt delay, windows does'nt need &
        # os.system("afplay bounce.wav&")
        winsound.PlaySound('boing.wav', winsound.SND_ASYNC)

    # bottom border
    if ball.ycor() < -290:
        ball.sety(-290)
        ball.dy *= -1
        winsound.PlaySound('boing.wav', winsound.SND_ASYNC)
    
    if ball.xcor() > 390:
        # reverse direction
        ball.dx *=-1
        # ball back to center
        ball.goto(0,0)
        score_a += 1
        # clear pevious score
        pen.clear()
        # print new score
        pen.write("Player A: {}  Player B: {}  ".format(score_a, score_b), align="center", font=("Courier", 24, "bold"))

    if ball.xcor() < -390:
        ball.dx *=-1
        ball.goto(0,0)
        score_b += 1
        pen.clear()
        pen.write("Player A: {}  Player B: {}  ".format(score_a, score_b), align="center", font=("Courier", 24, "bold"))

    # PADDLE AND BALL COLLISION
    # paddle a
    # test if the edges of x touching (not behind paddle) and is it between the top and bottom of paddle
    if (ball.xcor() < -340 and ball.xcor() > -350) and (ball.ycor() < paddle_a.ycor() + 40 and ball.ycor() > paddle_a.ycor() - 40):
        ball.setx(-340)
        ball.dx *= -1
        winsound.PlaySound('boing.wav', winsound.SND_ASYNC)

    # paddle b
    if (ball.xcor() > 340 and ball.xcor() <350) and (ball.ycor() < paddle_b.ycor() + 40 and ball.ycor() > paddle_b.ycor() - 40):
        ball.setx(340)
        ball.dx *= -1
        winsound.PlaySound('boing.wav', winsound.SND_ASYNC)
        
