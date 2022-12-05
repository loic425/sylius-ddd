<?php

namespace App\BookStore\Infrastructure\Sylius\Operation\Cli;

use Sylius\Component\Resource\Metadata\Operation as BaseOperation;

class Operation extends BaseOperation
{
    public function __construct(
        ?string $name = null,
        ?string $template = null,
        ?array $repository = null,
        ?array $criteria = null,
        ?array $serializationGroups = null,
        ?string $serializationVersion = null,
        ?array $requirements = null,
        ?array $options = null,
        ?string $host = null,
        ?array $schemes = null,
        ?int $priority = null,
        ?array $vars = null,
        string | array | bool | null $form = null,
        string | array | bool | null $factory = null,
        ?string $section = null,
        ?bool $permission = null,
        ?string $grid = null,
        ?bool $csrfProtection = null,
        string | array | null $redirect = null,
        ?array $stateMachine = null,
        ?string $event = null,
        ?bool $returnContent = null,
        ?string $resource = null,
        ?string $provider = null,
        ?string $processor = null,
        ?bool $read = null,
        ?bool $validate = null,
        ?bool $write = null,
        ?bool $respond = null,
        ?string $input = null,
    ) {
        parent::__construct(
            name: $name,
            template: $template,
            repository: $repository,
            criteria: $criteria,
            serializationGroups: $serializationGroups,
            serializationVersion: $serializationVersion,
            requirements: $requirements,
            options: $options,
            host: $host,
            schemes: $schemes,
            priority: $priority,
            vars: $vars,
            form: $form,
            factory: $factory,
            section: $section,
            permission: $permission,
            grid: $grid,
            csrfProtection: $csrfProtection,
            redirect: $redirect,
            stateMachine: $stateMachine,
            event: $event,
            returnContent: $returnContent,
            resource: $resource,
            provider: $provider,
            processor: $processor,
            read: $read,
            validate: $validate,
            write: $write,
            respond: $respond,
            input: $input,
        );
    }
}
