# Pfy

Pfy is a dev-tool for developers and teams to manage in a fashion way their command line scripts.

> Pfy is a work in progress. It is not ready for production.

## Features

- A cli tool connected to a cloud service to run scripts
- A web interface:
  - to manage scripts;
  - to update instantly the scripts on the cli tool;
  - to share scripts with the team;
- A json schema that allow to define the scripts and their options with built-in components;

## Reasons to use Pfy

In my experience, I have seen many teams that have a lot of scripts to manage their projects. These scripts are usually stored in a folder in the project and are shared with the team. The problem is that these scripts some times are copy-pasted from one project to another, and they are not updated or sometimes are very difficult to understand and use without documentation, a web interface, or a cli tool.

Sometimes, larger teams, build their own cli tool to manage these scripts, but this tool is not shared with the community, and it is not easy to maintain: release new versions, update the scripts, tell the team to update the cli tool, etc.

Pfy is a solution to these problems. It is a cli tool that is connected to a cloud service where the scripts are stored. The scripts are defined in a json schema that allows to define the scripts and their options with built-in components. The web interface allows to manage the scripts, update instantly the scripts on the cli tool, and share the scripts with the team.

## How it works

Pfy consists of two parts: a cli tool and a cloud service.

The cli tool is a command line interface that allows to run scripts. The scripts are stored in the cloud service and are defined in a json schema that allows to define the scripts and their options with built-in components.

The cloud service is a web interface that allows to manage the scripts, update instantly the scripts on the cli tool, and share the scripts with the team.
