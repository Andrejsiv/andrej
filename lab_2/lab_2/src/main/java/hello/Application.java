package hello;

import org.mariuszgromada.math.mxparser.Expression;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@SpringBootApplication
@RestController
public class Application {

    public static void main(String[] args) {
        SpringApplication.run(Application.class, args);
    }

   
    @GetMapping("/")
    public String home() {
        return "<!DOCTYPE html>"
                + "<html>"
                + "<head>"
                + "<title>Калькулятор</title>"
                + "</head>"
                + "<body>"
                + "<h1>Калькулятор</h1>"
                + "<form action='/calculate' method='GET'>"
                + "Введіть вираз: <input type='text' name='expression'><br><br>"
                + "<input type='submit' value='Розрахувати'>"
                + "</form>"
                + "</body>"
                + "</html>";
    }

   
    @GetMapping("/calculate")
    public String calculate(@RequestParam(value = "expression") String expression) {

        
        Expression exp = new Expression(expression);
        double result = exp.calculate();

        
        if (Double.isNaN(result)) {
            return "<!DOCTYPE html>"
                    + "<html>"
                    + "<head><title>П</title></head>"
                    + "<body>"
                    + "<h1>Помилка!</h1>"
                    + "<a href='/'>Назад</a>"
                    + "</body>"
                    + "</html>";
        }

        return "<!DOCTYPE html>"
                + "<html>"
                + "<head><title>Результат</title></head>"
                + "<body>"
                + "<h1>Результат: " + result + "</h1>"
                + "<a href='/'>Назад</a>"
                + "</body>"
                + "</html>";
    }
}