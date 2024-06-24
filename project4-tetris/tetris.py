# Amberly Loh Binti Mohd Azlan loh
# amberly456loh@gmail.com
# 19/6/2024 - 21/6/2024

# 1. IMPORT
import pygame
import random

pygame.font.init()

# 3. VARIABLES
# screen
s_width = 800
s_height = 700
# box
play_width = 300  # meaning 300 // 10 = 30 width per block
play_height = 600  # meaning 600 // 20 = 20 height per block
block_size = 30
# top left position of play area
top_left_x = (s_width - play_width) // 2
top_left_y = s_height - play_height


# 4. SHAPE FORMATS (and how it rotates)
S = [['.....',
	  '......',
	  '..00..',
	  '.00...',
	  '.....'],
	 ['.....',
	  '..0..',
	  '..00.',
	  '...0.',
	  '.....']]

Z = [['.....',
	  '.....',
	  '.00..',
	  '..00.',
	  '.....'],
	 ['.....',
	  '..0..',
	  '.00..',
	  '.0...',
	  '.....']]

I = [['..0..',
	  '..0..',
	  '..0..',
	  '..0..',
	  '.....'],
	 ['.....',
	  '0000.',
	  '.....',
	  '.....',
	  '.....']]

O = [['.....',
	  '.....',
	  '.00..',
	  '.00..',
	  '.....']]

J = [['.....',
	  '.0...',
	  '.000.',
	  '.....',
	  '.....'],
	 ['.....',
	  '..00.',
	  '..0..',
	  '..0..',
	  '.....'],
	 ['.....',
	  '.....',
	  '.000.',
	  '...0.',
	  '.....'],
	 ['.....',
	  '..0..',
	  '..0..',
	  '.00..',
	  '.....']]

L = [['.....',
	  '...0.',
	  '.000.',
	  '.....',
	  '.....'],
	 ['.....',
	  '..0..',
	  '..0..',
	  '..00.',
	  '.....'],
	 ['.....',
	  '.....',
	  '.000.',
	  '.0...',
	  '.....'],
	 ['.....',
	  '.00..',
	  '..0..',
	  '..0..',
	  '.....']]

T = [['.....',
	  '..0..',
	  '.000.',
	  '.....',
	  '.....'],
	 ['.....',
	  '..0..',
	  '..00.',
	  '..0..',
	  '.....'],
	 ['.....',
	  '.....',
	  '.000.',
	  '..0..',
	  '.....'],
	 ['.....',
	  '..0..',
	  '.00..',
	  '..0..',
	  '.....']]

# shapes is array so index 0 - 6
shapes = [S, Z, I, O, J, L, T]
shape_colors = [(0, 255, 0), (255, 0, 0), (0, 255, 255), (255, 255, 0), (255, 165, 0), (0, 0, 255), (128, 0, 128)]

# 5. DATA STRUCTURES (storage)
class Piece(object):
	def __init__(self, x, y, shape) :
		self.x = x
		self.y = y
		self.shape = shape
		self.color = shape_colors[shapes.index(shape)]
		self.rotation = 0 

# 6. FUNCTIONS

# 7. CREATE GRID
def create_grid(locked_pos = {}):
	# 10 colors because 10 squares in each row , underscores can be variables too
	grid = [[(0, 0, 0) for _ in range(10)] for _ in range (20)]
	# finding corresponding position to the locked position and change color in the grid to get accurate grid
	for i in range(len(grid)):
		for j in range(len(grid[i])):
			if (j, i) in locked_pos:
				c = locked_pos[(j, i)]
				grid[i][j] = c
	return grid

# 14. CONVERT SHAPE FORMAT
def convert_shape_format(shape):
	# genrate list of positions
	positions = []
	# this will give sublist(if current rotation is zero(not rotated), then we will get the first sublist as  gives remainder)
	format = shape.shape[shape.rotation % len(shape.shape)]
	for i, line in enumerate(format):
		row = list(line)
		for j, column in enumerate(row):
			if column == '0':
				positions.append((shape.x + j, shape.y + i))
	for i, pos in enumerate(positions):
		positions[i] = (pos[0] - 2, pos[1] - 4)

	return positions

# 15. VALID SPACE
def valid_space(shape, grid):
	# flatten list [[(0,1)],[(2,3)]] -> [(0,1),(2,3)] so its simpler
	accepted_pos = [[(j, i) for j in range(10)if grid[i][j]==(0,0,0)] for i in range(20)]
	# convert to 1D list
	accepted_pos = [j for sub in accepted_pos for j in sub]
	# get shae and convert it to pos
	formatted = convert_shape_format(shape) 
	# check data
	for pos in formatted:
		if pos not in accepted_pos:
			if pos[1] > -1:
				return False
	return True

# 16. CHECK LOST
def check_lost(positions):
	# check if any position is above the screen
	for pos in positions:
		x, y = pos
		if y < 1:
			return True
		
	return False

# 8. GET SHAPE
def get_shape():
	# it'll randomly pick a shape
	return Piece(5, 0, random.choice(shapes))

# 20. DRAW TEXT MIDDLE
def draw_text_middle(text, size, color, surface):
	font = pygame.font.SysFont('comicsans', size, bold=True)
	label = font.render(text,1,color)

	surface.blit(label, (top_left_x + play_width/2 - (label.get_width() / 2), top_left_y + play_height/2 - label.get_height()/2))

# 13. DRAW GRID
def draw_grid(surface, grid):
	# grid structure
	sx = top_left_x
	sy = top_left_y
	for i in range(len(grid)):
		pygame.draw.line(surface, ( 128, 128, 128), ( sx, sy + i * block_size), ( sx + play_width, sy + i * block_size))
		for j in range(len(grid[i])):
			pygame.draw.line(surface, ( 128, 128, 128), ( sx + J * block_size, sy), ( sx + j * block_size, sy + play_height))

#18. CLEAR ROWS 
def clear_rows(grid, locked):
	# zero zero zero does not exist = row should be cleared
	inc = 0
	for i in range(len(grid)-1,-1,-1):
		row = grid[i]
		if (0,0,0) not in row:
			inc += 1
			ind = i
			for j in range(len(row)):
				try:
					del locked[(i,j)]
				except:
					continue

	if inc > 0:
		for key in sorted(list(locked), key = lambda x: x[1])[::-1]:
			x, y = key
			#  if y above current index
			if y < ind:
				# add to y value to shift it down
				newkey = (x, y + inc)
				locked[newkey] = locked.pop[key]

	# score
	return inc

# 17. DRAW NEXT SHAPE
def draw_next_shape(shape, surface):
	# draw next shape off the screen and show what it is
	font = pygame.font.SysFont('comicsans', 30)
	label = font.render('Next Shape',1,(255,255,255))

	# where to draw
	sx = top_left_x + play_width+50
	sy = top_left_y + play_height/2 -100
	format = shape.shape(shape.rotation % len(shape.shape))

	for i, line in enumerate(format):
		row = list(line)
		for j, column in enumerate(row):
			if column == '0':
				pygame.draw.rect(surface, shape.color, (sx + j * block_size, sy + i * block_size, block_size, block_size),0)

	surface.blit(label, (sx + 10, sy-30))

# 21. UPDATE SCORE
def update_score(nscore):
	score = max_score
	with open('scores.txt','r') as f:
		if int(score)> nscore:
			f.write(str(score))
		else:
			f.write(str(nscore))

# 21. MAX SCORE()
def max_score():
	with open('scores.txt','r') as f:
		lines =  f.readlines()
		score = lines[0].strip()
		return score

# 12. DRAW WINDOW
def draw_window(surface, grid, score = 0, last_score=0):
	surface.fill((0, 0, 0))
	# draw title on things
	pygame.font.init()
	font = pygame.font.SysFont('comicsans', 60)
	label = font.render('Tetris', 1, (255, 255, 255))
	# draw label(center of screen)
	surface.blit(label, (top_left_x + play_width/2- (label.get_width()/2, 30)))
	
	# current score
	font = pygame.font.SysFont('comicsans', 30)
	label = font.render('Score: '+str(score),1,(255,255,255))
	# where to draw
	sx = top_left_x + play_width+50
	sy = top_left_y + play_height/2 -100
	surface.blit(label, (sx+20, sy+150))

	# last score
	label = font.render('High Score: '+last_score,1,(255,255,255))

	# where to draw
	sx = top_left_x - 200
	sy = top_left_y + 200

	surface.blit(label, (sx+20, sy+150))

	# draw grid object
	for i in range(len(grid)):
		for j in range(len(grid[i])):
			pygame.draw.rect(surface, grid[i][j], (top_left_x + j*block_size, top_left_y + i*block_size, block_size, block_size), 0)
	# draw red rectangle
	pygame.draw.rect(surface, (255, 0, 0), (top_left_x, top_left_y, play_width, play_height))
	
	# call funcion
	draw_grid(surface, grid)
	
# 11. MAIN
def main(win):
	# variables
	last_score = max_score
	locked_positions = {}
	grid = create_grid(locked_positions)
	change_piece = False
	run = True
	current_piece = get_shape()
	next_piece = get_shape()
	clock = pygame.time.Clock()
	fall_time = 0
	fall_speed = 0.27
	level_time = 0
	score = 0

	while run:
		grid = create_grid(locked_positions)
		fall_time += clock.get_rawtime()
		level_time += clock.get_rawtime()
		clock.tick()

		if level_time/1000 > 5:
			level_time = 0
			if fall_speed > 0.112:
				level_time -= 0.005 

		if fall_time/1000 > fall_speed:
			fall_time = 0
			current_piece.y += 1
			if not(valid_space(current_piece, grid)) and current_piece.y > 0:
				current_piece.y -= 1
				change_piece = True

		for event in pygame.event.get():
			if event.type == pygame.QUIT:
				run == False
				pygame.display.quit()

			if event.type == pygame.KEYDOWN:
				if event.key == pygame.K_LEFT:
					current_piece.x -= 1
					# check valid space(if not add one an dmove it back to where it was)
					if not(valid_space(current_piece, grid)):
						current_piece.x += 1
				if event.key == pygame.K_RIGHT:
					current_piece.x += 1
					if not(valid_space(current_piece, grid)):
						current_piece.x -= 1
				if event.key == pygame.K_DOWN:
					current_piece.y -= 1
					if not(valid_space(current_piece, grid)):
						current_piece.y += 1
				if event.key == pygame.K_UP:
					current_piece.rotation += 1
					if not(valid_space(current_piece, grid)):
						current_piece.rotation -= 1

		# to see if hit the ground or locked
		shape_pos = convert_shape_format(current_piece)

		for i in range(len(shape_pos)):
			x, y = shape_pos[i]
			if y > -1:
				grid[y][x] = current_piece.color

		if change_piece:
			for pos in shape_pos:
				p = (pos[0], pos[1])
				locked_positions[p] = current_piece.color
			current_piece = next_piece
			next_piece = get_shape()
			change_piece = False
			# 19. SCORE
			score += clear_rows(grid, locked_positions) * 10
			# display

		# draw grid
		draw_window(win, grid, score, last_score)
	
		draw_next_shape(next_piece,win)
	pygame.display.update()
	
		# check if loss the game
	if check_lost(locked_positions):
		draw_text_middle(win,"YOU LOST!", 80,(255,255,255))
		pygame.display.update()
		pygame.time.delay(1500)
		run = False	
		update_score(score)

# 20. MAIN MENU
def main_menu(win):
	run = True
	while run:
		win.fill((0,0,0))
		draw_text_middle('Press any key to begin.', 60, (255, 255, 255), win)
		pygame.display.update()
		for event in pygame.event.get():
			if event.type == pygame.QUIT:
				run = False
			if event.type == pygame.KEYDOWN:
				main(win)

win = pygame.display.set_mode((s_width, s_height))
pygame.display.set_caption('Tetris')
main_menu(win)  # start game