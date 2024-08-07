# Pfy - More prompts, less prompts

## Getting Started

---

Install the cli:

```bash
curl -s https://raw.githubusercontent.com/promptify-it/cli/main/installer.sh | bash
```

Create a token from Web Application:

1. Click on `Api Tokens`;
2. Give it a name and click on `Create`;
3. Copy the token;
4. Save the token in a safe place.

Add the token to the cli with the following command:

```bash
pfy auth:token
```

The cli will ask for the token. Paste it and press enter.

Thats it! You are ready to go.

## Usage

---

```bash
pfy list
```


## Create a new prompt

---

1. Create a new command from Web Ui
2. Give it a name and a description (fill signature and description)
3. Add nodes to the command.

### Available nodes

- **Assign**

    Assign a value to a variable
    
    ```json
    {
        "type": "assign",
        "content": {
            "key": "NAME",
            "value": "Daniele"
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | key | Variable name | String | No |
    | value | Value to assign | String | No |

- **Condition**
    
    ```json
    {
        "type": "condition",
        "content": {
            "left": "{{ $NAME }}",
            "operator": "==",
            "right": "Daniele"
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | left | Left side of the condition | String | Yes |
    | operator | Operator | `==`, `===`, `!=`, `!==`, `>`, `<`, `>=`, `<=` | No |
    | right | Right side of the condition | String | Yes |


- **FileTemplate**
  
    Generate a file from a template.
    The template is an array of strings.
    Each string is a line of the file. The output is the file name.

    You can use variables in the template. Variables are defined with `{{ $VARIABLE_NAME }}`.

    ```json
    {
        "type": "file-template",
        "content": {
            "template": [
                "<?php",
                "",
                "class {{ $NAME_studly }} {",
                "    public function __construct() {",
                "        echo 'Hello, World!';",
                "    }",
                "}"
                ""
            ],
            "output": "$NAME.php"
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | template | Template | Array of strings | Yes |
    | output | Output file name | String | Yes |


- **PassworInput**

    Ask for a password

    ```json
    {
        "type": "password-input",
        "content": {
            "key": "name",
            "label": "Type your password",
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | key | Variable name | String | No |
    | label | Value to assign | String | No |

- **SelectInput**

    Ask for a selection

    ```json
    {
        "type": "select-input",
        "content": {
            "key": "name",
            "label": "John",
            "options": [
                "Option 1",
                "Option 2",
                "Option 3"
            ]
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | key | Variable name | String | No |
    | label | Value to assign | String | No |
    | options | Options | Array of strings | No |

- **Shell**

    Execute a shell script

    ```json
    {
        "type": "shell",
        "content": {
            "script": "echo 'Hello, World!'"
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | script | Shell script | String | Yes |


- **TextInput**

    Ask for a text input

    ```json
    {
        "type": "text-input",
        "content": {
            "key": "name",
            "label": "What's your name?",
        }
    }
    ```

    | Key | Description | Values | Support variables |
    |:----|:----------- | :------| :----------------- |
    | key | Variable name | String | No |
    | label | Value to assign | String | No |



[def]: #pfy---more-prompts-less-prompts
