<?php

require_once INCLUDE_DIR . 'class.plugin.php';

class ZulipPluginConfig extends PluginConfig {

    // Provide compatibility function for versions of osTicket prior to
    // translation support (v1.9.4)
    function translate() {
        if (!method_exists('Plugin', 'translate')) {
            return array(
                function ($x) {
                    return $x;
                },
                function ($x, $y, $n) {
                    return $n != 1 ? $y : $x;
                }
            );
        }
        return Plugin::translate('zulip');
    }

    function pre_save($config, &$errors) {
        if ($config['zulip-regex-subject-ignore'] && false === @preg_match("/{$config['zulip-regex-subject-ignore']}/i", null)) {
            $errors['err'] = 'Your regex was invalid, try something like "spam", it will become: "/spam/i" when we use it.';
            return FALSE;
        }
        return TRUE;
    }

    function getOptions() {
        list ($__, $_N) = self::translate();

        return array(
            'zulip'                      => new SectionBreakField(array(
                'label' => $__('Zulip notifier'),
                'hint'  => $__('Readme first: https://github.com/clonemeagain/osticket-zulip')
                    )),
            'zulip-webhook-url'          => new TextboxField(array(
                'label'         => $__('Webhook URL'),
                'configuration' => array(
                    'size'   => 100,
                    'length' => 200
                ),
                    )),
            'zulip-user'             => new TextboxField(array(
                'label' => $__('Zulip User'),
                'hint'  => $__('Generate on from your Zulip Bot configuration page'),
                'configuration' => array( 'size' => 100, 'length' => 200),
            )),
            'zulip-api-token'             => new TextboxField(array(
                'label' => $__('Zulip API Key'),
                'hint'  => $__('Generate on from your Zulip Bot configuration page'),
                'configuration' => array( 'size' => 100, 'length' => 200),
            )),
            'zulip-stream'             => new TextboxField(array(
                'label' => $__('Zulip Stream'),
                'hint'  => $__('Stream to send the messages'),
                'configuration' => array( 'size' => 100, 'length' => 200),
            )),
                            
            'zulip-regex-subject-ignore' => new TextboxField([
                'label'         => $__('Ignore when subject equals regex'),
                'hint'          => $__('Auto delimited, always case-insensitive'),
                'configuration' => [
                    'size'   => 30,
                    'length' => 200
                ],
                    ]),
            'message-template'           => new TextareaField([
                'label'         => $__('Message Template'),
                'hint'          => $__('The main text part of the Zulip message, uses Ticket Variables, for what the user typed, use variable: %{zulip_safe_message}'),
                // "<%{url}/scp/tickets.php?id=%{ticket.id}|%{ticket.subject}>\n" // Already included as Title
                'default'       => "%{ticket.name.full} (%{ticket.email}) in *%{ticket.dept}* _%{ticket.topic}_\n\n```%{zulip_safe_message}```",
                'configuration' => [
                    'html' => FALSE,
                ]
                    ])
        );
    }

}
