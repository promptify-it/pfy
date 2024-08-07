# 02. Pfy - Examples

### Hello, World!

Go at https://pfy.dedecube.com/commands/create to create a script:

```json
{
    "signature": "hello",
    "description": "Say hello",
    "root": {
        "nodes": [
            {
                "type": "shell",
                "content": {
                    "script": "echo 'Hello, World!'"
                }
            }
        ]
    }
}
```

Then, in the cli tool, run the script:

```bash
pfy hello
```

The output will be:

```bash
Hello, World!
```

### Text input and variable in shell script

In web interface, create a new script with that json content:

```json
{
    "signature": "say-my-name",
    "description": "Say my name",
    "root": {
        "nodes": [
            {
                "type": "text-input",
                "content": {
                    "key": "NAME",
                    "label": "What is your name?"
                }
            },
            {
                "type": "shell",
                "content": {
                    "script": "echo $NAME"
                }
            }
        ]
    }
}
```

Then, in the cli tool, run the script:

```bash
pfy say-my-name
```

## Get started

### Install dependencies

```bash
composer install
```

### Monorepo Commands

Merge composer.json files:

```bash
vendor/bin/monorepo-builder merge
```

Validate composer.json files:

```bash
vendor/bin/monorepo-builder validate
```
