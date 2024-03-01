<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Customer;
use App\Controllers\Controller;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class CustomerController extends Controller
{

    // ****challenge solution***
    public function add(): void
    {
        $this->render('add.twig');
    }

    public function save(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // if the request is not a POST request, redirect to the add page
            header('Location: /customers/add');
            exit;
        }

        if ($fields = Customer::validate()) {
            $customer = new Customer(
                $fields['lastName'],
                $fields['firstName'],
                $fields['address']
            );

            $customer->create();

            $_SESSION['message'] = 'Customer added successfully';
        }

        header('Location: /customers/add');
    }

    public function edit(int $id): void
    {
        $customer = Customer::find($id);

        // customer not found
        if ($customer === false) {
            $_SESSION['message'] = 'Customer not found';
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($fields = Customer::validate()) {
                $customer->setLastName($fields['lastName'])
                    ->setFirstName($fields['firstName'])
                    ->setAddress($fields['address'])
                    ->update();

                $_SESSION['message'] = 'Customer updated successfully';
                header('Location: /');
                exit;
            }
        }

        $this->render('edit.twig', ['customer' => $customer]);
    }

    public function delete(int $id): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $customer = Customer::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer->delete();
            $_SESSION['message'] = 'Customer deleted successfully';

            // $this->mailExample();
            // $this->symfonyMailHog();
            $this->symfonyTwigEmail($customer);

            header('Location: /');
            exit;
        }

        $this->render('delete.twig', ['customer' => $customer]);
    }

    public function mailExample(): bool
    {
        $to = 'recipient@example.com';
        $from = 'no-reply@example.com';
        $name = 'Customer App';
        $subject = 'Subject of the email';
        $message = 'Hello, this is a test email';
        $headers = "From: $name <$from>\r\n";

        return mail($to, $subject, $message, $headers);
    }

    public function symfonyMailHog()
    {
        $dsn = 'smtp://mailhog:1025';
        //format smtp://{email}:{password}@smtp.example.com:25
        $dsn = "smtp://example@outlook.com:password@smtp-mail.outlook.com:587";

        //create Transport object from dsn
        $transport = Transport::fromDsn($dsn);

        // create mailer
        $mailer = new Mailer($transport);

        // create Address object
        $fromAddress = new Address('no-reply@example.com', 'Customer App');

        // using Email class
        $email = (new Email())
            ->from($fromAddress)
            ->to('recipient@example.com')
            ->subject('Using Email class')
            ->text('Sending email from SMTP')
            ->html('<h1>Sending email from SMTP</h1>');

        //send email
        $mailer->send($email);
    }

    public function symfonyTwigEmail(Customer $customer)
    {
        $dsn = 'smtp://mailhog:1025';
        //format smtp://{email}:{password}@smtp.example.com:25
        // $dsn = "smtp://example@outlook.com:password@smtp-mail.outlook.com:587";

        //create Transport object from dsn
        $transport = Transport::fromDsn($dsn);

        // create mailer
        $mailer = new Mailer($transport);

        // create Address object
        $fromAddress = new Address('no-reply@example.com', 'Customer App');

        // using Email class
        $email = (new TemplatedEmail())
            ->from($fromAddress)
            ->to('recipient@example.com')
            ->subject('Using Email class')
            ->htmlTemplate('Emails/CustomerDelete.twig')
            ->context([
                'customer' => $customer,
            ]);

        $twigBodyRenderer = new BodyRenderer($this->twig);
        $twigBodyRenderer->render($email);

        //send email
        $mailer->send($email);
    }
}
