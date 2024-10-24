package hello;

import org.mariuszgromada.math.mxparser.Expression;

public class Calculator {

    public double calculate(String arg){
      Expression expression = new Expression(arg);
		  double result = expression.calculate();
      return result;
    }
}
