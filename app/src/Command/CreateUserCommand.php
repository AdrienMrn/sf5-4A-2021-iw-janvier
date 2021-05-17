<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    /**
     * @var EntityManagerInterface $om
     */
    private $om;

    public function __construct(string $name = null, EntityManagerInterface $om)
    {
        parent::__construct($name);

        $this->om = $om;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
            ->addArgument('pwd', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Création d\'un nouvel utilisateur</info>');
        $output->writeln('<info>---------------------------------</info>');
        $output->writeln(' ');

        $helper = $this->getHelper('question');
        $question = new Question('Please enter the email of user: ');
        $email = $helper->ask($input, $output, $question);

        $user = (new User())
            ->setPassword($input->getArgument('pwd'))
            ->setEmail($email)
        ;

        $this->om->persist($user);
        $this->om->flush();

        return Command::SUCCESS;
    }
}