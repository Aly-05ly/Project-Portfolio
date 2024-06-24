
//1. IMPORT
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;

public class Calculator implements ActionListener{

//	3. Declarations
	JFrame frame;
	JTextField textfield;
	JButton[] numberButtons = new JButton[10];
	JButton[] functionButtons = new JButton[9];
	JButton addButton, subButton, mulButton, divButton;
	JButton decButton, equButton, delButton, clrButton, negButton;
//	panel to hold buttons
	JPanel panel;
	
	Font myFont = new Font("comicsans", Font.BOLD, 30);
	
	double num1 = 0, num2 = 0, result = 0;
	char operator;
	
//	2. CONTRUCTORS
	Calculator(){
//		initialize
		frame = new JFrame("Calculator");
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);;
		frame.setSize(420, 550);
		frame.setLayout(null);
		
		textfield = new JTextField();
		textfield.setBounds(50, 25, 300, 50);
		textfield.setFont(myFont);
		textfield.setEditable(false);
		
//		buttons
		addButton = new JButton("+");
		subButton = new JButton("-");
		mulButton = new JButton("*");
		divButton = new JButton("/");
		decButton = new JButton(".");
		equButton = new JButton("=");
		delButton = new JButton("Del");
		clrButton = new JButton("Clr");
		negButton = new JButton("(-)");
		
//		add buttons to function
		functionButtons[0] = addButton;
		functionButtons[1] = subButton;
		functionButtons[2] = mulButton;
		functionButtons[3] = divButton;
		functionButtons[4] = decButton;
		functionButtons[5] = equButton;
		functionButtons[6] = delButton;
		functionButtons[7] = clrButton;
		functionButtons[8] = negButton;
		
//		for loop to loop 9 times
		for(int i = 0; i<9; i++) {
			functionButtons[i].addActionListener(this);
			functionButtons[i].setFont(myFont);
//			remove the red line
			functionButtons[i].setFocusable(false);
		}
		
//		for loop to loop 10 times
		for(int i=0; i<10; i++){
			numberButtons[i] = new JButton(String.valueOf(i));
			numberButtons[i].addActionListener(this);
			numberButtons[i].setFont(myFont);
//			remove the red line
			numberButtons[i].setFocusable(false);
		}
		
//		negative & delete & clear Buttons
		negButton.setBounds(50, 430, 80, 50);
		delButton.setBounds(132, 430, 115, 50);
		clrButton.setBounds(248, 430, 105, 50);
		
//		panel
		panel = new JPanel();
		panel.setBounds(50, 100, 300, 300);
		panel.setLayout(new GridLayout(4, 4, 10, 10));
		
//		add button to panel
		panel.add(numberButtons[1]);
		panel.add(numberButtons[2]);
		panel.add(numberButtons[3]);
		panel.add(addButton);
		panel.add(numberButtons[4]);
		panel.add(numberButtons[5]);
		panel.add(numberButtons[6]);
		panel.add(subButton);
		panel.add(numberButtons[7]);
		panel.add(numberButtons[8]);
		panel.add(numberButtons[9]);
		panel.add(mulButton);
		panel.add(decButton);
		panel.add(numberButtons[0]);
		panel.add(equButton);
		panel.add(divButton);
		
//		add negative clear and delete to frame
		frame.add(negButton);
		frame.add(delButton);
		frame.add(clrButton);
//		add text field to frame
		frame.add(textfield);
		frame.setVisible(true);
//		add panel to frame
		frame.add(panel);
      
	}

  public static void main(String[] args) {
		@SuppressWarnings("unused")
        Calculator calc = new Calculator();
	}
	
	public void actionPerformed(ActionEvent e) {
		for(int i = 0; i<10; i++) {
			if(e.getSource() == numberButtons[i]) {
				textfield.setText(textfield.getText().concat(String.valueOf(i)));
			}
		}
		
//		decimal
		if(e.getSource() == decButton) {
			textfield.setText(textfield.getText().concat("."));
		}
		
//		add
		if(e.getSource() == addButton) {
			num1 = Double.parseDouble(textfield.getText());
			operator = '+';
			textfield.setText("");
		}
		
//		subtract
		if(e.getSource() == subButton) {
			num1 = Double.parseDouble(textfield.getText());
			operator = '-';
			textfield.setText("");
		}
		
//		multiply
		if(e.getSource() == mulButton) {
			num1 = Double.parseDouble(textfield.getText());
			operator = '*';
			textfield.setText("");
		}
		
//		divide
		if(e.getSource() == subButton) {
			num1 = Double.parseDouble(textfield.getText());
			operator = '/';
			textfield.setText("");
		}
		
//		equal
		if(e.getSource() == equButton) {
			num2 = Double.parseDouble(textfield.getText());
			switch(operator) {
			case '+':
				result = num1 + num2;
				break;
			case '-':
				result = num1 - num2;
				break;
			case '*':
				result = num1 * num2;
				break;
			case '/':
				result = num1 / num2;
				break;
			}
			
//			update text field
			textfield.setText(String.valueOf(result));
			num1 = result;
		}
		
//		clear
		if(e.getSource() == clrButton) {
			num1 = Double.parseDouble(textfield.getText());
			textfield.setText("");
		}
		
//		delete
		if(e.getSource() == delButton) {
			String string = textfield.getText();
			textfield.setText("");
			for(int i = 0; i<string.length() - 1; i++) {
			textfield.setText(textfield.getText()+string.charAt(i));
			}
		}

//		negative
		if(e.getSource() == negButton) {
			double temp = Double.parseDouble(textfield.getText());
//			flip
			temp *= -1;
			textfield.setText(String.valueOf(temp));
		}
	}

}
