<?php

    namespace LENON\WAPP\CMD;

    use Symfony\Component\Console\Command\Command;

    class SendMsg extends Command
    {
        protected static $defaultDescription = 'Creates a new user.';

        protected static $defaultName="app:create";

        protected function configure()
        {
            $this
                // the command help shown when running the command with the "--help" option
                ->setHelp('This command allows you to create a user...')
            ;
        }
    }
