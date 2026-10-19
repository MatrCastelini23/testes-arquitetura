# Testes que sustentam a arquitetura

Conteúdo dia 01:

| Duração | Conteúdo                                                       | Formato                    |
|---------|----------------------------------------------------------------|----------------------------|
| 15 min  | Abertura: Por que nossos testes falham em proteger o software? | Discussão + demonstração   |
| 25 min  | Cobertura não é garantia de qualidade                          | Teoria + prática           |
| 35 min  | Testando comportamentos, não implementações                    | Mão na massa               |
| 10 min  | Intervalo                                                      | Pausa                      |
| 35 min  | Test Doubles: Dummy, Stub, Spy, Mock e Fake                    | Teoria + exemplos práticos |
| 45 min  | Criando um Repository In-Memory                                | Mão na massa               |
| 15 min  | Desafio final e fechamento                                     | Exercício + discussão      |

Dia 1
1. Por que os testes deixam bug passar?
```php
final class DiscountCalculator
{
    public function calculate(
        float $price,
        float $discount
    ): float {
        return $price - ($price * $discount);
    }
}

public function testCalculate(): void
{
    $calculator = new DiscountCalculator();

    $result = $calculator->calculate(100, 0.10);

    $this->assertIsFloat($result);
}

public function testShouldApplyTenPercentDiscount(): void
{
    $calculator = new DiscountCalculator();

    $result = $calculator->calculate(100, 0.10);

    // porque isso?
    $this->assertEqualsWithDelta(
        90.0,
        $result,
        0.001
    );
}
```
2. Cobertura e pontos cegos
```php
final class ShippingCalculator
{
    public function calculate(float $amount): float
    {
        if ($amount >= 200) {
            return 0;
        }

        return 25;
    }
}

public function testShipping(): void
{
    $calculator = new ShippingCalculator();

    $shipping = $calculator->calculate(250);

    $this->assertGreaterThanOrEqual(0, $shipping);
}
```

Gerar o coverage e notar a cobertura.

Aprimorar a cobertura:

| Cenário                     | Valor da compra | Frete esperado |
|-----------------------------|----------------:|---------------:|
| Compra abaixo do mínimo     |          R$ 100 |          R$ 25 |
| Compra exatamente no mínimo |          R$ 200 |           R$ 0 |
| Compra acima do mínimo      |          R$ 300 |           R$ 0 |

3. Comportamento e refatoração
```src/Application/Service/OrderService.php```

Exercício
Solicite aos participantes que escrevam testes para:
- Impedir a criação de pedidos sem itens.
- Calcular corretamente o total.
- Aplicar desconto acima de R$ 500.
- Não aplicar desconto em pedidos de exatamente R$ 500.

4. Intervalo


5. Dummy, Stub, Spy, Mock e Fake
6. 
   | Tipo  | Responsabilidade                                  | Exemplo                                       |
   |-------|---------------------------------------------------|-----------------------------------------------|
   | Dummy | Preencher uma dependência que não será utilizada  | Um objeto obrigatório no construtor           |
   | Stub  | Fornecer respostas predefinidas                   | Simular o retorno de uma consulta             |
   | Spy   | Registrar interações para posterior verificação   | Registrar chamadas de envio de e-mail         |
   | Mock  | Validar interações esperadas                      | Verificar uma chamada para um serviço externo |
   | Fake  | Oferecer uma implementação funcional simplificada | Repository In-Memory                          |

6. Repository In-Memory

```php
final class InMemoryOrderRepository implements OrderRepository
{
    private array $orders = [];

    public function save(Order $order): void
    {
        $this->orders[] = $order;
    }

    public function findById(string $id): ?Order
    {
        return $this->orders[$id] ?? null;
    }
}
```

7. Fechamento


--

1. O problema dos Fakes
2. Introdução aos Contract Tests
3. Contract Tests na prática
4. Introdução ao Mutation Testing
5. Mutation Testing com Infection
6. Protegendo a arquitetura
7. Encerramento	Revisão e boas práticas