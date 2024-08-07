# 01. Pfy - Get Started

## Installation

To use pfy you need to install the CLI and to have an account (and getting the API key).

### Install the CLI

For Linux and MacOS, run the following command:

```bash
curl -s https://raw.githubusercontent.com/promptify-it/cli/main/installer.sh | bash
```

For Windows, currently the only way is to use the [Windows Subsystem for Linux](https://docs.microsoft.com/en-us/windows/wsl/install).

Windows support is planned for the future.

### Create an account

To create an account, go to [Promptify-IT](https://promptify.it) and sign up.

### Get the API key

After creating an account, go to the [API key page](https://promptify.it/api-key) and copy the key.

### Configure the CLI

To configure the CLI, run the following command:

```bash
pfy auth:token
```

And paste the API key in the prompt.

## Verify the installation

To verify the installation, run the following command:

```bash
pfy auth:me
```

The output should be a json representation of the user.

## Create your first command

1. Go to Dashboard
<img src="https://eu2.contabostorage.com/68b2a8dc1bcd4997b931953a37002ef5:pfy/public/pfy-commands.png" />

2. Create a command
<img src="https://eu2.contabostorage.com/68b2a8dc1bcd4997b931953a37002ef5:pfy/public/pfy-create-command.png" />

3. Run in the CLI
<img src="https://eu2.contabostorage.com/68b2a8dc1bcd4997b931953a37002ef5:pfy/public/cli-say-my-name.png">
<img src="https://eu2.contabostorage.com/68b2a8dc1bcd4997b931953a37002ef5:pfy/public/cli-say-my-name-output.png">