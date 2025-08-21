from django.db import models
from django.core.validators import RegexValidator
from django.utils import timezone


class TimeStampedModel(models.Model):
    created_at = models.DateTimeField(default=timezone.now, editable=False)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        abstract = True


class Department(TimeStampedModel):
    name = models.CharField(max_length=200, unique=True)
    code = models.CharField(
        max_length=20,
        unique=True,
        validators=[RegexValidator(r"^[A-Za-z0-9_-]+$", "Only letters, numbers, _ and - allowed")],
    )
    description = models.TextField(blank=True)

    def __str__(self) -> str:
        return f"{self.code} - {self.name}"


class Team(TimeStampedModel):
    name = models.CharField(max_length=200)
    department = models.ForeignKey(Department, on_delete=models.PROTECT, related_name="teams")
    email = models.EmailField(blank=True)

    class Meta:
        unique_together = ("name", "department")

    def __str__(self) -> str:
        return f"{self.name} ({self.department.code})"


class Tag(TimeStampedModel):
    name = models.CharField(max_length=100, unique=True)

    def __str__(self) -> str:
        return self.name


class Resource(TimeStampedModel):
    class ResourceType(models.TextChoices):
        APPLICATION = "application", "Application"
        SERVICE = "service", "Service"
        SERVER = "server", "Server/Host"
        DATABASE = "database", "Database"
        STORAGE = "storage", "Storage"
        NETWORK = "network", "Network"
        OTHER = "other", "Other"

    name = models.CharField(max_length=255)
    resource_type = models.CharField(max_length=50, choices=ResourceType.choices, default=ResourceType.OTHER)
    department = models.ForeignKey(Department, on_delete=models.PROTECT, related_name="resources", null=True, blank=True)
    owner_team = models.ForeignKey(Team, on_delete=models.PROTECT, related_name="owned_resources", null=True, blank=True)
    support_teams = models.ManyToManyField(Team, related_name="supported_resources", blank=True)
    description = models.TextField(blank=True)
    metadata = models.JSONField(default=dict, blank=True)
    tags = models.ManyToManyField(Tag, related_name="resources", blank=True)

    class Meta:
        unique_together = ("name", "resource_type")

    def __str__(self) -> str:
        return f"{self.name}"


class ResourceRelationshipType(TimeStampedModel):
    name = models.CharField(max_length=100, unique=True)
    description = models.TextField(blank=True)
    is_symmetric = models.BooleanField(default=False)

    def __str__(self) -> str:
        return self.name


class ResourceRelationship(TimeStampedModel):
    relation_type = models.ForeignKey(
        ResourceRelationshipType,
        on_delete=models.CASCADE,
        related_name="relationships",
    )
    source = models.ForeignKey(Resource, on_delete=models.CASCADE, related_name="outgoing_relationships")
    target = models.ForeignKey(Resource, on_delete=models.CASCADE, related_name="incoming_relationships")
    metadata = models.JSONField(default=dict, blank=True)

    class Meta:
        constraints = [
            models.CheckConstraint(check=~models.Q(source=models.F("target")), name="resource_rel_not_reflexive"),
            models.UniqueConstraint(fields=["relation_type", "source", "target"], name="unique_relation_type_pair"),
        ]

    def __str__(self) -> str:
        return f"{self.source} -[{self.relation_type}]-> {self.target}"

