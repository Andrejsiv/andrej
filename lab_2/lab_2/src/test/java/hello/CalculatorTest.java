package hello;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.assertEquals;

public class CalculatorTest {

  @Test
  public void test1(){
    Calculator calculator = new Calculator();
    double value = calculator.calculate("1+1");
    assertEquals(2D, value);
  }
  
  // @Test
  // public void test2(){
  // Calculator calculator = new Calculator();
  // double value = calculator.calculate("5+2");
  // assertEquals(2D, value);
  //}
}
