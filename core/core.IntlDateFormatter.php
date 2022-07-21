<?php
 class IntlDateFormatter {
/* Méthodes */
public __construct(
    ?string $locale,
    int $dateType,
    int $timeType,
    IntlTimeZone|DateTimeZone|string|null $timezone = null,
    IntlCalendar|int|null $calendar = null,
    string $pattern = ""
)
public static create(
    ?string $locale,
    int $dateType,
    int $timeType,
    IntlTimeZone|DateTimeZone|string|null $timezone = null,
    IntlCalendar|int|null $calendar = null,
    string $pattern = ""
): ?IntlDateFormatter
public format(IntlCalendar|DateTimeInterface|array|string|int|float $datetime): string|false
public static formatObject(IntlCalendar|DateTime $datetime, array|int|string|null $format = null, ?string $locale = null): string|false
public getCalendar(): int|false
public getDateType(): int|false
public getErrorCode(): int
public getErrorMessage(): string
public getLocale(int $type = ULOC_ACTUAL_LOCALE): string|false
public getPattern(): string|false
public getTimeType(): int|false
public getTimeZoneId(): string|false
public getCalendarObject(): IntlCalendar|false|null
public getTimeZone(): IntlTimeZone|false
public isLenient(): bool
public localtime(string $string, int &$offset = null): array|false
public parse(string $string, int &$offset = null): int|float|false
public setCalendar(IntlCalendar|int|null $calendar): bool
public setLenient(bool $lenient): void
public setPattern(string $pattern): bool
public setTimeZone(IntlTimeZone|DateTimeZone|string|null $timezone): ?bool
}